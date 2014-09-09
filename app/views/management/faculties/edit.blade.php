@extends('management.layout')
@section('body')
<div class="container-xs">
	<div class="page-header clearfix text-center">
		<h3>Edit Faculty</h3>
	</div>
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
@stop