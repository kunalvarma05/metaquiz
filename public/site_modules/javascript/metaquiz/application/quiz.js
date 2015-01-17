/**
 * Name: The Quiz
 * Author: Kunal Varma
 * Version: 0.1
 */
 jQuery(document).ready(function($) {
	//Set a option selection flag to curb idiotic clicks
	window.option_selected = false;
	/**
	 * timer The Quiz Question Timer
	 */
	 var timer = jQuery(".quiz-question-timer").TimeCircles(
	 {
		start: false, //auto start
		total_duration: 11, // timer duration
		direction: "Clockwise", //Rotation
		bg_width: 1,
		fg_width: 0.1,
		circle_bg_color: "#333356",
		time: {
			Days: { show: false },
			Hours: { show: false },
			Minutes: { show: false },
			Seconds: {
				show: true,
				color: "blueviolet"
			}
		}
	});

	//When the count reaches 0
	timer.addListener(function(unit, value, total) {
		if(parseInt(total) < 0){
			timer.stop();
			noOptionSelected();
		}
	});

	//Fetch the QuizID
	var quiz_id = jQuery('#quiz_id').val();
	//Get the CSRF token
	var token = jQuery('meta[name=_token]').attr('content');

	//Fetch unanswered Questions from the backend
	var getQuestion = function(){
		jQuery(".quiz-question-timer").removeClass("in");
		//Make an AJAX call to do the job
		jQuery.ajax({
			url: "/app/quiz/questions",
			type: "POST",
			data: {"quiz_id":quiz_id},
			headers: { 'X-CSRF-Token' : token }
		})
		.done(function(data) {
			//If there are remaining unanswered questions
			if(!data.all_answered){
				//Show the progress bar
				jQuery(".quiz-marks").fadeIn(500);
				//Prepare the template
				var html = jQuery("#quiz-questions").inject(data);
				//Inject into existing DOM
				jQuery(".quiz-canvas").html(html);
				//Hide the options
				jQuery(".quiz-question-options").fadeOut(0);
				//Rebuild the timer
				timer = timer.restart().stop();
				//Show the timer
				jQuery(".quiz-question-timer").addClass("in");
				//Wait for 3 seconds before displaying the options and starting the timer
				setTimeout(function(){
					//Shit was successfull
					timer.restart();
					jQuery(".quiz-question-options").fadeIn(200);
				}, 3000);
			}else{
				//If all the questions have been answered
				jQuery(".play-quiz-page").fadeOut(400).remove();
				//Hide the results loader
				jQuery(".quiz-result-loader").delay(500).fadeIn(400);
				//Redirect to quiz page
				setTimeout(function(){
					window.location =  routes.route('app.quiz.results', { "quiz_id" : quiz_id });
				}, 1000);
			}
		})
		.fail(function(response) {
			//Shit just got real!
			console.log(response);
		});
	};


	/**
	 * Check the Answer
	 * @param  JSON data
	 */
	 var checkAnswer = function(data){
	 	//Marks Count
	 	var count = jQuery('.quiz-marks .mark-count');
	 	//Progress
	 	var progress = jQuery('.quiz-marks .progress');
	 	//Marks Update Bar
	 	var bar = jQuery('.quiz-marks .progress-bar');
	 	//Progress Height
	 	var progressHeight = progress.height();
	 	console.log(progressHeight);
		//Check if the answer is correct
		if(data.is_correct){
			//The answer is correct
			var total = parseInt(count.text());
			//Marks Earned
			var earned = parseInt(data.marks);
			//Marks Increased
			var marksIncreament = parseInt(20-earned);
			//Current Height of the Progress Bar
			var currentHeight = bar.height();
			//Increament to be done to the Progress Bar
			var increament = progressHeight*marksIncreament/100;
			//New Height
			var newHeight = bar.height() + increament;
			console.log(newHeight);
			//Show correct answer state
			count.addClass('success');
			bar.addClass('progress-bar-success');
			//Increase the height of the bar
			bar.height(newHeight);
			//Increase the marks
			count.text(parseInt(total+parseInt(data.marks)));
			//Remove the correct answer state
			setTimeout(function(){
				count.removeClass('success');
				bar.removeClass('progress-bar-success');
			}, 1500);
		}else{
			//The answer is incorrect
			count.addClass('danger');
			bar.addClass('progress-bar-danger');
			//Remove the incorrect answer state
			setTimeout(function(){
				count.removeClass('danger');
				bar.removeClass('progress-bar-danger');
			}, 1500);
		}
	};

	//Get the Questions when the page loads
	getQuestion();

	//When the user chooses an option
	jQuery(document).on('click','.quiz-question-option', function(){
		//If the option is not already selected
		if(!window.option_selected){
			//Stop the time
			timer.stop();
			//Get the Time remaining
			var time_remaining = parseInt(timer.getTime());
			//Option choosen
			var option = jQuery(this);
			//Add the class active
			jQuery(this).addClass('active');
			//ID of the Option Choosen
			var option_id = option.data('option-id');
			//ID of the question being answered
			var question_id = option.data('question-id');

			//Check the answer via an AJAX call
			jQuery.ajax({
				url: "/app/quiz/check/answer",
				type: "POST",
				data: {"quiz_id":quiz_id, "question_id":question_id,"option_id":option_id,"time_remaining":time_remaining},
				headers: { 'X-CSRF-Token' : token }
			})
			.done(function(data) {
				//Check the Answer
				checkAnswer(data);
				//Get the next Question
				getQuestion();
			})
			.fail(function(response) {
				console.log(response);
			})
			.always(function(response){
				console.log(response);
			});
		}
	});

	//noOptionSelected
	var noOptionSelected = function(){

		//If the option is not already selected
		if(!window.option_selected){
			//Stop the time
			timer.stop();
			//Get the Time remaining
			var time_remaining = parseInt(timer.getTime());
			//Option choosen
			var option = jQuery(".quiz-question-option").first();
			//ID of the option selected
			var option_id = option.data('option-id');
			//ID of the question being answered
			var question_id = option.data('question-id');

			//Check the answer via an AJAX call
			jQuery.ajax({
				url: "/app/quiz/no-answer-chosen",
				type: "POST",
				data: {"quiz_id":quiz_id, "question_id":question_id,"option_id":option_id,"time_remaining":time_remaining},
				headers: { 'X-CSRF-Token' : token }
			})
			.done(function(data) {
				//Check the Answer
				checkAnswer(data);
				//Get the next Question
				getQuestion();
			})
			.fail(function(response) {
				console.log(response);
			})
			.always(function(response){
				console.log(response);
			});
		};
	}
});