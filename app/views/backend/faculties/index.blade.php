@extends('backend.layout')
@section('sub-header-title')
Faculties
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-faculties') }}
@stop
@section('sub-header-actions')
<a href="{{route('management.faculties.create')}}" class="btn btn-lg btn-block btn-success"><span class="glyphicon glyphicon-plus"></span> Create Faculty</a>
@stop
@section('main-content')
<div class="faculties-page">
	<div class="container">
			@if(count($faculties))
				<div class="row">
					@foreach($faculties as $faculty)
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="brick">
							<div class="brick-content media">
								<img src="{{profilePic($faculty->picture)}}" class="pull-left img-64 img-circle media-object">
								<div class="media-body">
								<a href="{{route('management.faculties.show', $faculty->id)}}" class="brick-title">{{$faculty->name}}</a>
								<span class="timeago brick-micro-info">Added on {{$faculty->created_at->format('jS M, Y')}}</span>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			@else
			<div class="well-sm panel panel-default text-center">
				<p>
					No faculties Found!
				</p>
			</div>
			@endif
	</div>
</div>
@stop