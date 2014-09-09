<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admin-navbar-main">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{url('/')}}">MetaQuiz</a>
		</div>
		<div class="collapse navbar-collapse" id="admin-navbar-main">
			<ul class="nav navbar-nav">
				<li class="{{HTML::activeState('management.dashboard')}}">
					<a href="{{route('management.dashboard')}}">Dashboard</a>
				</li>
				<li class="{{HTML::activeState('management.courses.index')}}">
					<a href="{{route('management.courses.index')}}">Courses</a>
				</li>
				<li class="{{HTML::activeState('management.faculties.index')}}">
					<a href="{{route('management.faculties.index')}}">Faculty</a>
				</li>
				<li>
					<a href="{{route('management.courses.index')}}">Students</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{route('logout')}}">Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>