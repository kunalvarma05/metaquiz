@extends('management.layout')
@section('body')
<div class="subjects-page">
	{{ Breadcrumbs::render('management-chapter', $course, $subject, $chapter) }}
	<div class="container-sm page-center-1">
		<div class="clearfix panel panel-default alert">
			<h3 class="page-header">{{$chapter->name}} <a href="{{route('management.courses.subjects.chapters.edit', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-xs btn-default pull-right">Edit</a></h3>
			<p>
				{{$chapter->description}}
			</p>
			<div class="alert text-center">
				<a href="{{route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id))}}" class="btn btn-primary btn-lg">View Questions</a>
			</div>
		</div>
	</div>
</div>
@stop