<script id="online-user-template" type="text/x-handlebars-template">
	<div class="widget-item">
	<a href="#" title="Challenge @{{name}}" data-user-id="@{{id}}"> <img src="{{url('/assets/pictures')}}/users/@{{picture}}" class="widget-item-image" alt="pic"> <span class="widget-item-text">@{{name}} <i class="online"></i></span></a>
	</div>
</script>

<script id="quiz-questions" type="text/x-handlebars-template">
	<div class="quiz-question-block">
		<div class="quiz-question">
			@{{title}}
		</div>
		<div class="quiz-question-options row">
			@{{#each options}}
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div data-option-id="@{{id}}" data-question-id="@{{../id}}" class="quiz-question-option block">
					@{{title}}
				</div>
			</div>
			@{{/each}}
		</div>
	</div>
</script>