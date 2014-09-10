@extends('backend.layout')
@section('sub-header-title')
	Create Faculty
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-faculties-create') }}
@stop
@section('sub-header-actions')
	<a href="{{route('management.faculties.index')}}" class="btn btn-lg btn-default btn-block"><span class="glyphicon glyphicon-book-open"></span> All faculties</a>
@stop
@section('main-content')
<div class="create-faculty-page from-top-6">
	<div class="container container-xs">
		{{Form::open(array('route' => array("management.faculties.store"), 'class' => "form", 'method' => "post"))}}
		@if($errors->count())
		<div class="alert alert-danger text-center well-sm">
			<small>{{$errors->first()}}</small>
		</div>
		@endif
		<div class="form-group">
			{{Form::text('name', Input::old('name'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Name"))}}
		</div>
		<div class="form-group">
			{{Form::text('email', Input::old('email'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Email"))}}
		</div>
		<div class="form-group">
			{{Form::label('gr_no','Gr. Number')}}
			{{Form::text('gr_no', Input::old('gr_no'), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "GR. Number"))}}
		</div>
		<div class="form-group">
			{{Form::label('subjects[]', 'Assigned Subjects')}}
			{{Form::select('subjects[]', $subjects, array(), array('class' => "form-control input-lg", 'required' => "required", 'placeholder' => "Subjects", 'rows' => '6', 'multiple' => "multiple"))}}
		</div>
		<div class="form-group">
			{{Form::submit('Invite', array('class' => "btn btn-success btn-lg"))}}
		</div>
		{{Form::close()}}
	</div>
</div>
@stop