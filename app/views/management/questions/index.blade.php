@extends('management.layout')
@section('body')
<div class="courses-page">
	{{ Breadcrumbs::render('management-questions', $course, $subject, $chapter) }}
	<div class="container page-center-1">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="page-header clearfix"><div class="pull-right">{{$questions->links()}}</div> <h3 class="pull-left">{{$chapter->name}} | Questions</h3></div>
			@if(count($questions))
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					@foreach ($questions as $question)
					<a href="{{route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="panel panel-default well-sm text-center block"><b>
						{{$question->title}}
					</b></a>
					@if(count($question->options))
					<div class="row">
						@foreach($question->options as $option)
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							@if($option->is_answer)
							<div class="btn-success well-sm text-center btn-block">
								<b>{{$option->title}}</b>
							</div>
							@else
							<div class="panel panel-default well-sm text-center">
								<b>{{$option->title}}</b>
							</div>
							@endif
						</div>
						@endforeach
					</div>
					@endif
					<hr>
					@endforeach
				</div>
			</div>
			<div class="alert text-center">
				{{$questions->links()}}
			</div>
			@else
			<div class="alert alert-block text-center">
				<b>No Questions Found!</b>
				<p class="alert">
					<a href="#" class="btn btn-success">Add Questions</a>
				</p>
			</div>
			@endif
		</div>
	</div>
</div>
@stop