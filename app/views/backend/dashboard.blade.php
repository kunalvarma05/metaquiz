@extends('backend.layout')
@section('sub-header-title')
Dashboard
@stop
@section('sub-header-breadcrumbs')
{{ Breadcrumbs::render('management-dashboard') }}
@stop
@section('sub-header-actions')
<a href="#" id="backend-tour-button" class="btn btn-info btn-lg btn-block">Take a Tour</a>
@stop
@section('main-content')
<div class="dashboard">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget active-daily-players-chart">
					<div class="widget-header">
						<div class="title">Daily Active Players</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Last 7 Days</a>
						</div>
					</div>
					<canvas class="block alert" height="350px" id="active-daily-players-chart"></canvas>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget total-wins-chart">
					<div class="widget-header">
						<div class="title">Total Games Played</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Last 7 Days</a>
						</div>
					</div>
					<canvas class="block alert" height="200px" id="total-plays-chart"></canvas>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget total-wins-chart">
					<div class="widget-header">
						<div class="title">Total Wins</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Last 7 Days</a>
						</div>
					</div>
					<canvas class="block alert" height="200px" id="total-wins-chart"></canvas>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget total-draws-chart">
					<div class="widget-header">
						<div class="title">Total Draws</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Last 7 Days</a>
						</div>
					</div>
					<canvas class="block alert" height="200px" id="total-draws-chart"></canvas>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget total-losses-chart">
					<div class="widget-header">
						<div class="title">Total Losses</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Last 7 Days</a>
						</div>
					</div>
					<canvas class="block alert" height="200px" id="total-losses-chart"></canvas>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget popular-chapters-chart">
					<div class="widget-header">
						<div class="title">Most Played Chapters</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Top 3</a>
						</div>
					</div>
					<canvas class="block alert" height="250px" id="popular-chapters-chart"></canvas>
					<div class="widget-footer">
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget top-players-chart">
					<div class="widget-header">
						<div class="title">Top Players</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-info">Top 3</a>
						</div>
					</div>
					<div class="widget-content">
						<div class="widget-list">
							<div class="widget-list-item">
								<div class="widget-list-content media">
									<img src="http://localhost:8000/assets/pictures/users/f.jpeg" class="pull-left img-64 img-circle media-object">
									<div class="media-body">
										<a href="http://localhost:8000/management/students/38" class="widget-list-title">Kunal Varma</a>
									</div>
									<div class="widget-list-info">
										<div>
											Total Score: <b>700 XP</b>
										</div>
										<div>
											Total Achievements: <b>18</b>
										</div>
									</div>
									<span class="widget-list-rank">1</span>
								</div>
							</div>
							<div class="widget-list-item">
								<div class="widget-list-content media">
									<img src="http://localhost:8000/assets/pictures/users/a.jpg" class="pull-left img-64 img-circle media-object">
									<div class="media-body">
										<a href="http://localhost:8000/management/students/38" class="widget-list-title">Vandit Sharma</a>
									</div>
									<div class="widget-list-info">
										<div>
											Total Score: <b>650 XP</b>
										</div>
										<div>
											Total Achievements: <b>15</b>
										</div>
									</div>
									<span class="widget-list-rank">2</span>
								</div>
							</div>
							<div class="widget-list-item">
								<div class="widget-list-content media">
									<img src="http://localhost:8000/assets/pictures/users/b.jpg" class="pull-left img-64 img-circle media-object">
									<div class="media-body">
										<a href="http://localhost:8000/management/students/38" class="widget-list-title">Yash Shah</a>
									</div>
									<div class="widget-list-info">
										<div>
											Total Score: <b>600 XP</b>
										</div>
										<div>
											Total Achievements: <b>16</b>
										</div>
									</div>
									<span class="widget-list-rank">3</span>
								</div>
							</div>
							<div class="widget-list-item">
								<div class="widget-list-content media">
									<img src="http://localhost:8000/assets/pictures/users/c.jpg" class="pull-left img-64 img-circle media-object">
									<div class="media-body">
										<a href="http://localhost:8000/management/students/38" class="widget-list-title">Mehul Mistry</a>
									</div>
									<div class="widget-list-info">
										<div>
											Total Score: <b>520 XP</b>
										</div>
										<div>
											Total Achievements: <b>9</b>
										</div>
									</div>
									<span class="widget-list-rank">4</span>
								</div>
							</div>
							<div class="widget-list-item">
								<div class="widget-list-content media">
									<img src="http://localhost:8000/assets/pictures/users/d.jpg" class="pull-left img-64 img-circle media-object">
									<div class="media-body">
										<a href="http://localhost:8000/management/students/38" class="widget-list-title">Karan Varma</a>
									</div>
									<div class="widget-list-info">
										<div>
											Total Score: <b>400 XP</b>
										</div>
										<div>
											Total Achievements: <b>10</b>
										</div>
									</div>
									<span class="widget-list-rank">5</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 cl-sm-12 col-xs-12">
				<div class="widget dashboard-widget dark-widget basic-stats-widget">
					<div class="widget-header">
						<div class="title">Statistics</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-primary">Settings</a>
						</div>
					</div>
					<div class="widget-content clearfix">
						<div class="aggregate-count">
							<span class="count">60</span>
							<span class="count-label">Students</span>
						</div>
						<div class="aggregate-count">
							<span class="count">15</span>
							<span class="count-label">Faculties</span>
						</div>
						<div class="aggregate-count">
							<span class="count">6</span>
							<span class="count-label">Courses</span>
						</div>
						<div class="aggregate-count">
							<span class="count">40</span>
							<span class="count-label">Subjects</span>
						</div>
						<div class="aggregate-count">
							<span class="count">200</span>
							<span class="count-label">Games Played</span>
						</div>
						<div class="aggregate-count">
							<span class="count">2000</span>
							<span class="count-label">Questions</span>
						</div>
					</div>
				</div>
				<div class="widget dashboard-widget dark-widget about-widget">
					<div class="widget-header">
						<div class="title">About MetaQuiz</div>
						<div class="widget-actions">
							<a href="#" class="btn btn-xs btn-primary">Say Hello!</a>
						</div>
					</div>
					<div class="widget-content">
						<div class="about-text">
							MetaQuiz is a real-time quiz platform. It lets students challenge and play against their friends and classmates in epic quiz battles, with questions based on their study syllabus. This helps students learn efficiently whilst making sure the fun isn't lost ;)
						</div>
					</div>
				</div>
				<div class="widget dashboard-widget dark-widget quote-widget">
					<div class="widget-header">
						<div class="title"><i>Ignorance is bliss.</i></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('add-foot')
{{javascript_include_tag('charts.js')}}
@stop