<div class="column-heading">
	Select a course
</div>
@foreach($courses as $course)
<a data-target="#course-{{$course->id}}-subjects" data-parent=".subject-list" class="topic multi-state"> <span class="topic-thumb">{{substr($course->name,0,1)}}</span> <span class="topic-text">{{$course->name}}</span> <i class="glyphicon glyphicon-chevron-right pull-right arrow"></i></a>
@endforeach