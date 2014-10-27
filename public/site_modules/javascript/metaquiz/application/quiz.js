/**
 * The Quiz
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
		}
		//console.log(total);
	});

	//Fetch the QuizID
	var quiz_id = jQuery('#quiz_id').val();
	//Get the CSRF token
	var token = jQuery('meta[name=_token]').attr('content');

	//Fetch unanswered Questions from the backend
	var getQuestions = function(){
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
				//Prepare the template
				var html = jQuery("#quiz-questions").inject(data);
				//Inject into existing DOM
				jQuery(".quiz-canvas").html(html);
				//Hide the options
				jQuery(".quiz-question-options").fadeOut(0);
				//Rebuild the timer
				timer.destroy().rebuild();
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
				jQuery(".quiz-result-page").delay(500).fadeIn(400);
			}
		})
		.fail(function(response) {
			//Shit just got real!
			console.log(response);
		});
	};

	//Get the Questions when the page loads
	getQuestions();

	//When the user chooses an option
	jQuery(document).on('click','.quiz-question-option', function(){
		if(!window.option_selected){
			//Stop the time
			timer.stop();
			//Time remaining
			var time_remaining = parseInt(timer.getTime());
			//Option choosen
			var option = jQuery(this);
			jQuery(this).addClass('active');
			var option_id = option.data('option-id');
			//The question being answered
			var question_id = option.data('question-id');

			//Check the answer via an AJAX call
			jQuery.ajax({
				url: "/app/quiz/check/answer",
				type: "POST",
				data: {"quiz_id":quiz_id, "question_id":question_id,"option_id":option_id,"time_remaining":time_remaining},
				headers: { 'X-CSRF-Token' : token }
			})
			.done(function(data) {
				getQuestions();
			})
			.fail(function(response) {

			})
			.always(function(response){
				console.log(response);
			});
		}
	});
});