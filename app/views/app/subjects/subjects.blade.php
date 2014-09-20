<div class="column-heading">
	Select a Subject
</div>
@foreach($courses as $course)
<div class="drawer subjects-drawer no-show" id="course-{{$course->id}}-subjects">
	@foreach($course->subjects as $subject)
	<div class="topic-group">
		<a data-target="#subject-submenu-{{$subject->id}}" class="topic multi-state toggle-sub-menu"> <span class="topic-thumb">{{substr($subject->name,0,1)}}</span> <span class="topic-text">{{$subject->name}}</span> <i class="glyphicon glyphicon-chevron-down pull-right arrow"></i></a>
		<div class="collapse sub-menu-collapse clearfix" id="subject-submenu-{{$subject->id}}">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="{{route('app.quiz.create', array($subject->course_id, $subject->id))}}" class="btn btn-success btn-block">PLAY</a>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
				<a href="#" class="btn btn-danger btn-block">RANKINGS</a>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endforeach