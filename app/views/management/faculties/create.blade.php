@extends('management.layout')
@section('body')
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Invite Faculty</h3>
	</div>
	{{Form::open(array('route' => array("management.faculties.store"), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', Input::old('name'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::text('email', Input::old('email'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Email"))}}
	</div>
	<div class="form-group">
		{{Form::label('gr_no','Gr. Number')}}
		{{Form::text('gr_no', Input::old('gr_no'), array('class' => "form-control", 'required' => "required", 'placeholder' => "GR. Number"))}}
	</div>
	<div class="form-group">
		{{Form::label('subjects[]', 'Assigned Subjects')}}
		{{Form::select('subjects[]', $subjects, array(), array('class' => "form-control", 'required' => "required", 'placeholder' => "Subjects", 'rows' => '6', 'multiple' => "multiple"))}}
	</div>
	<div class="form-group">
		{{Form::submit('Invite', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
</div>
@stop