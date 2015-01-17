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

<script id="user-profile-modal" type="text/x-handlebars-template">
	<div class="modal-dialog modal-sm modal-dialog-center">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn  btn-sm pull-right" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
				<h4 class="modal-title" id="user-modalLabel">@{{name}}</h4>
			</div>
			<div class="text-center modal-body">
				<a href="#" class="block"> <img src="{{url('/assets/pictures')}}/users/@{{picture}}" class="user-pic" alt="Pic"> <h3>@{{name}}</h3> </a>
				<span class="text-muted block">Level 10, Master</span>
			</div>
			<div class="modal-footer text-center">
				@{{#if is_friend}}
				<a href="#" class="btn btn-lg btn-success btn-block"><span class="glyphicon glyphicon-ok"></span> Friends</a>
				@{{else}}
				<a href="#" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-plus"></span> Add Friend</a>
				@{{#/if}}
			</div>
		</div>
	</div>
</script>

<script id="quiz-result-template" type="text/x-handlebars-template">
	<div class="quiz-result">
		<div class="quiz-questions">
			@{{#each questions_asked}}
				<div class="quiz-questions well-sm panel panel-default">
					@{{question.title}}
				</div>
			@{{/each}}
		</div>
	</div>
</script>