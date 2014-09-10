@extends('backend.layout')
@section('sub-header-title')
	{{$faculty->name}}
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-faculty-edit', $faculty) }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.faculties.index')}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All faculties</a>
@stop
@section('main-content')
<div class="create-faculty-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.faculties.update", $faculty->id), 'class' => "form", 'method' => "put"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::label('gr_no','Gr. Number')}}
			{{Form::text('gr_no', $faculty->accountable->gr_no, array('class' => "form-control", 'required' => "required", 'placeholder' => "GR. Number"))}}
		</div>
		<div class="form-group">
			{{Form::label('subjects[]', 'Assigned Subjects')}}
			{{Form::select('subjects[]', $subjects, $assignedSubjects, array('class' => "form-control", 'placeholder' => "Subjects", 'rows' => '6', 'multiple' => "multiple"))}}
		</div>
		<div class="form-group">
			{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop