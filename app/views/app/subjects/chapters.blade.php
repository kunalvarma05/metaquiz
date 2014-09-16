<div class="column-heading">
	Select a Chapter
</div>
@foreach($courses as $course)
@foreach($course->subjects as $subject)
<div class="drawer chapters-drawer no-show" id="subject-{{$subject->id}}-chapters">
	@foreach($subject->chapters as $chapter)
	<div class="topic multi-state">
		<span class="topic-thumb">{{substr($chapter->name,0,1)}}</span>
		<span class="topic-text">{{$chapter->name}}</span>
		<i class="glyphicon glyphicon-chevron-right pull-right arrow"></i>
	</div>
	@endforeach
</div>
@endforeach
@endforeach