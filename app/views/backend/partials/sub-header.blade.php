<!--Sub Header-->
	<div class="sub-header clearfix">
		<div class="container">
			<div class="row">
				<div class="sub-header-title col-lg-10 col-md-9 col-sm-9 col-xs-12">
					<h2 class="title">
						@yield('sub-header-title')
					</h2>
					@yield('sub-header-breadcrumbs')
				</div>
				<div class="sub-header-actions col-lg-2 col-md-3 col-sm-3 col-xs-12 pull-right">
					@yield('sub-header-actions')
				</div>
			</div>
		</div>
	</div>
<!--End: Sub Header-->