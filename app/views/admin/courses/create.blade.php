@extends('admin.layout')
@section('body')
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Create Course</h3>
	</div>
	{{Form::open(array('route' => array("admin.organizations.courses.store", $organization->id), 'class' => "form", 'method' => "post"))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group">
		{{Form::text('name', Input::old('name'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', Input::old('description'), array('class' => "form-control", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>	
	<div class="form-group">
		{{Form::submit('Create', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::hidden('organization_id', $organization->id)}}
	{{Form::close()}}
</div>
@stop