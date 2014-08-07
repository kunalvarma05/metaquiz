<div class="column-heading">
	Select a chapter
</div>
@foreach($courses as $course)
@foreach($course->subjects as $subject)
<div class="collapse" id="subject-{{$subject->id}}-chapters">
	@foreach($subject->chapters as $chapter)
	<a href="#chapter-submenu-{{$chapter->id}}" class="topic multi-state toggle-sub-menu"> <span class="topic-thumb">{{substr($chapter->name,0,1)}}</span> <span class="topic-text">{{$chapter->name}}</span> <i class="glyphicon glyphicon-chevron-down pull-right arrow"></i></a>
	<div class="collapse sub-menu-collapse clearfix" id="chapter-submenu-{{$chapter->id}}">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
			<a href="#" class="btn btn-success btn-block">PLAY</a>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pane">
			<a href="#" class="btn btn-danger btn-block">CHALLENGE</a>
		</div>
	</div>
	@endforeach
</div>
@endforeach
@endforeach