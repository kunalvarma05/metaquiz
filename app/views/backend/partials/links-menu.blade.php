<!--Links Menu-->
	<div class="links-menu clearfix" id="backend-links-menu">
		<div class="links-menu-inside">
			<ul>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="{{route('management.dashboard')}}" class="{{HTML::activeState('management.dashboard')}} dashboard-icon" title="Dashboard"><i class="icon icon-home"></i><span>Dashboard</span></a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="{{route('management.courses.index')}}" title="Courses" class="{{HTML::activeState('management.courses.index')}} course-icon"><i class="icon icon-book-open"></i><span>Courses</span></a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="{{route('management.faculties.index')}}" title="Faculty" class="{{HTML::activeState('management.faculties.index')}} faculty-icon"><i class="icon icon-users"></i><span>Faculty</span></a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="{{route('management.students.index')}}" title="Students" class="{{HTML::activeState('management.students.index')}} student-icon"><i class="icon icon-graduation"></i><span>Students</span></a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="#" title="Reports" class="report-icon"><i class="icon icon-pie-chart"></i><span>Reports</span></a>
				</li>
				<li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
					<a href="#" title="Settings" class="setting-icon"><i class="icon icon-settings"></i><span>Settings</span></a>
				</li>
			</ul>
		</div>
	</div>
<!--End: Links Menu-->