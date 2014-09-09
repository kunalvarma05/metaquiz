@extends('management.layout')
@section('body')
<div class="courses-page">
	{{ Breadcrumbs::render('management-question', $course, $subject, $chapter, $question) }}
	<div class="container page-center-1">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class=" pull-right well-sm">
				<a href="{{route('management.courses.subjects.chapters.questions.edit', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="btn btn-xs btn-default">Edit</a>
				<a href="{{route('management.courses.subjects.chapters.questions.destroy', array($course->id, $subject->id, $chapter->id, $question->id))}}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this question? It is irreversible!');">Delete</a>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
				</div>
			</div>
		</div>
	</div>
</div>
@stop