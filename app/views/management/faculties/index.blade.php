@extends('management.layout')
@section('body')
<div class="faculties-page">
	<div class="container page-center-1">
		<div class="faculties">
			<h3 class="page-header">Faculties <a href="{{route('management.faculties.create')}}" class="btn btn-xs btn-success pull-right">Create</a></h3>
			<div class="row">
				@if(count($faculties))
				@foreach($faculties as $faculty)
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="panel panel-default well-sm media">
						<img src="{{profilePic($faculty->picture)}}" class="pull-left media-object img-64 img-circle">
						<div class="media-body">
							<a href="{{route('management.faculties.show', $faculty->id)}}"><b class="list-group-item-heading">{{$faculty->name}}</b></a>
							@if(count($faculty->accountable->subjects))
							<div class="clearfix page-center-1">
								@foreach($faculty->accountable->subjects as $subject)
								<a href="{{route('management.courses.subjects.show', array($subject->course_id, $subject->id))}}" class="btn-xs btn text-muted small">{{$subject->name}}</a>
								@endforeach
							</div>
							@endif
						</div>
					</div>
				</div>
				@endforeach
				@else
				<div class="well-sm panel panel-default text-center">
					<p>
						No faculties Found!
					</p>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop