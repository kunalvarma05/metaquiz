<!--Navbar Main-->
	<nav class="navbar navbar-default navbar-static-top navbar-main" role="navigation">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main-collapse">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{url('/')}}">MetaQuiz</a>
	      	<a href="#" title="Main Menu" class="links-menu-toggle pull-left btn navbar-btn" data-toggle="links-menu" data-target="#backend-links-menu"><span class="glyphicon glyphicon-th"></span> <b>Menu</b></a>
	    </div>
	    <div class="collapse navbar-collapse" id="navbar-main-collapse">
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="navbar-organization"><a href="#"><img src="{{orgPic(Auth::user()->organization->picture)}}" alt="org"> {{Auth::user()->organization->name}}</a></li>
	        <li class="dropdown navbar-profile">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{profilePic(Auth::user()->picture)}}" alt="user" class="padded"> {{Auth::user()->name}} <span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="#">Profile</a></li>
	            <li><a href="#">Settings</a></li>
	            <li class="divider"></li>
	            <li><a href="{{route('logout')}}">Logout</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div>
	  </div>
	</nav>
<!--End: Navbar Main-->