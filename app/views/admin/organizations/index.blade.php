@extends('admin.layout')
@section('body')
<div class="container">
	<div class="page-header clearfix">
		<h3>Organizations <a href="{{route('admin.organizations.create')}}" class="btn btn-success pull-right btn-sm">Create</a></h3>
	</div>
	@if(count($organizations))
	<div class="row">
		@foreach($organizations as $organization)
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="media panel panel-default well-sm">
				<a class="pull-left" href="{{route('admin.organizations.show', $organization->id)}}"> <img class="media-object img-64" src="{{orgPic($organization->picture)}}"> </a>
				<div class="media-body">
					<h4 class="media-heading"><a href="{{route('admin.organizations.show', $organization->id)}}">{{$organization->name}}</a></h4>
					<p>
						<a href="{{route('admin.organizations.edit', $organization->id)}}" class="text-muted small">Edit</a>
					</p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@else
	<div class="alert text-center text-muted">
		No organizations found!
	</div>
	@endif
</div>
@stop