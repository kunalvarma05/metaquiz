<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admin-navbar-main">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{url('/')}}">MQ</a>
		</div>
		<div class="collapse navbar-collapse" id="admin-navbar-main">
			<ul class="nav navbar-nav">
				<li class="{{HTML::activeState('admin.organizations.index')}}">
					<a href="{{route('admin.organizations.index')}}">Organizations</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="{{route('logout')}}">Logout</a>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>