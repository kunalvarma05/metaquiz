<div class="column-heading">
	Select a subject
</div>
@foreach($courses as $course)
<div class="collapse subject-collapse" id="course-{{$course->id}}-subjects">
	@foreach($course->subjects as $subject)
	<div class="topic-group">
		<a href="#subject-submenu-{{$subject->id}}" class="topic multi-state toggle-sub-menu"> <span class="topic-thumb">{{substr($subject->name,0,1)}}</span> <span class="topic-text">{{$subject->name}}</span> <i class="glyphicon glyphicon-chevron-down pull-right arrow"></i></a>
		<div class="collapse sub-menu-collapse clearfix" id="subject-submenu-{{$subject->id}}">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="#" class="btn btn-success btn-block">PLAY</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="#" class="btn btn-danger btn-block">CHALLENGE</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="#subject-{{$subject->id}}-chapters" data-parent=".chapter-list" class="btn btn-primary btn-block toggle-chapter">CHAPTERS</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="#" class="btn btn-info btn-block">RANKINGS</a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endforeach