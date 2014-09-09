@extends('admin.layout')
@section('body')
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Edit Organization</h3>
	</div>
	{{Form::open(array('route' => array("admin.organizations.update", $organization->id), 'class' => "form", 'method' => "put", 'files' => true))}}
	@if($errors->count())
	<div class="alert alert-danger text-center well-sm">
		<small>{{$errors->first()}}</small>
	</div>
	@endif
	<div class="form-group text-center">
		<a href="#"><img src="{{orgPic($organization->picture)}}" class="img-circle img-120 img-thumbnail"></a>
	</div>
	<div class="form-group">
		{{Form::text('name', $organization->name, array('class' => "form-control", 'required' => "required", 'placeholder' => "Name"))}}
	</div>
	<div class="form-group">
		{{Form::textarea('description', $organization->description, array('class' => "form-control", 'required' => "required", 'placeholder' => "Description", 'rows' => '6'))}}
	</div>
	<div class="form-group">
		{{Form::label('picture', "Upload Picture", array('class' => "btn btn-block btn-default"))}}
		{{Form::file('picture', array('class' => "hidden"))}}
	</div>
	<div class="form-group">
		{{Form::submit('Update', array('class' => "btn btn-primary btn-block btn-lg"))}}
	</div>
	{{Form::close()}}
	{{Form::open(array('route' => array('admin.organizations.destroy', $organization->id), 'method' => "DELETE", 'onsubmit' => "return confirm('Are you sure you want to delete this organization? It is irreversible!');"))}}
	{{Form::submit('Delete', array('class' => "btn-link btn-block text-muted small"))}}
	{{Form::close()}}
</div>
@stop