<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{config('app.name')}}</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>
		<?php $authedUser = Auth::guard('admin')->user(); ?>
	</head>
	<body class="skin-blue">
		<!-- header logo: style can be found in header.less -->
		<header class="header">
		<a href="index.html" class="logo">
			<!-- Add the class icon to your logo image or logo icon to add the margining -->
			{{config('app.name')}}
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
					<span class="label label-success">4</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 4 messages</li>
					<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
						<li><!-- start message -->
						<a href="#">
							<div class="pull-left">
								<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="User Image"/>
							</div>
							<h4>
								Support Team
								<small><i class="fa fa-clock-o"></i> 5 mins</small>
							</h4>
							<p>Why not buy a new awesome theme?</p>
						</a>
						</li><!-- end message -->
						<li>
						<a href="#">
							<div class="pull-left">
								<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="user image"/>
							</div>
							<h4>
								AdminLTE Design Team
								<small><i class="fa fa-clock-o"></i> 2 hours</small>
							</h4>
							<p>Why not buy a new awesome theme?</p>
						</a>
						</li>
						<li>
						<a href="#">
							<div class="pull-left">
								<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="user image"/>
							</div>
							<h4>
								Developers
								<small><i class="fa fa-clock-o"></i> Today</small>
							</h4>
							<p>Why not buy a new awesome theme?</p>
						</a>
						</li>
						<li>
						<a href="#">
							<div class="pull-left">
								<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="user image"/>
							</div>
							<h4>
								Sales Department
								<small><i class="fa fa-clock-o"></i> Yesterday</small>
							</h4>
							<p>Why not buy a new awesome theme?</p>
						</a>
						</li>
						<li>
						<a href="#">
							<div class="pull-left">
								<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="user image"/>
							</div>
							<h4>
								Reviewers
								<small><i class="fa fa-clock-o"></i> 2 days</small>
							</h4>
							<p>Why not buy a new awesome theme?</p>
						</a>
						</li>
					</ul>
					</li>
					<li class="footer"><a href="#">See All Messages</a></li>
				</ul>
				</li>
				<!-- Notifications: style can be found in dropdown.less -->
				<li class="dropdown notifications-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-warning"></i>
					<span class="label label-warning">10</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 10 notifications</li>
					<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
						<li>
						<a href="#">
							<i class="ion ion-ios7-people info"></i> 5 new members joined today
						</a>
						</li>
						<li>
						<a href="#">
							<i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
						</a>
						</li>
						<li>
						<a href="#">
							<i class="fa fa-users warning"></i> 5 new members joined
						</a>
						</li>

						<li>
						<a href="#">
							<i class="ion ion-ios7-cart success"></i> 25 sales made
						</a>
						</li>
						<li>
						<a href="#">
							<i class="ion ion-ios7-person danger"></i> You changed your username
						</a>
						</li>
					</ul>
					</li>
					<li class="footer"><a href="#">View all</a></li>
				</ul>
				</li>
				<!-- Tasks: style can be found in dropdown.less -->
				<li class="dropdown tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-tasks"></i>
					<span class="label label-danger">9</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 9 tasks</li>
					<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
						<li><!-- Task item -->
						<a href="#">
							<h3>
								Design some buttons
								<small class="pull-right">20%</small>
							</h3>
							<div class="progress xs">
								<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">20% Complete</span>
								</div>
							</div>
						</a>
						</li><!-- end task item -->
						<li><!-- Task item -->
						<a href="#">
							<h3>
								Create a nice theme
								<small class="pull-right">40%</small>
							</h3>
							<div class="progress xs">
								<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">40% Complete</span>
								</div>
							</div>
						</a>
						</li><!-- end task item -->
						<li><!-- Task item -->
						<a href="#">
							<h3>
								Some task I need to do
								<small class="pull-right">60%</small>
							</h3>
							<div class="progress xs">
								<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">60% Complete</span>
								</div>
							</div>
						</a>
						</li><!-- end task item -->
						<li><!-- Task item -->
						<a href="#">
							<h3>
								Make beautiful transitions
								<small class="pull-right">80%</small>
							</h3>
							<div class="progress xs">
								<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">80% Complete</span>
								</div>
							</div>
						</a>
						</li><!-- end task item -->
					</ul>
					</li>
					<li class="footer">
					<a href="#">View all tasks</a>
					</li>
				</ul>
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-user"></i>
					<span>{{isset($authedUser->name)?$authedUser->name:'游客'}} <i class="caret"></i></span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header bg-light-blue">
					<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="User Image" />
					<p>
					{{isset($authedUser->name)?$authedUser->name:'游客'}} - Web Developer
					<small>Member since {{isset($authedUser->created_at)?$authedUser->created_at:''}}</small>
					</p>
					</li>
					<!-- Menu Body -->
					<li class="user-body">
					<div class="col-xs-4 text-center">
						<a href="#">Followers</a>
					</div>
					<div class="col-xs-4 text-center">
						<a href="#">Sales</a>
					</div>
					<div class="col-xs-4 text-center">
						<a href="#">Friends</a>
					</div>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Profile</a>
					</div>
					<div class="pull-right">
						<a href="{{ url('/logout') }}" class="btn btn-default btn-flat"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
						<form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</div>
					</li>
				</ul>
				</li>
			</ul>
		</div>
		</nav>
		</header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="left-side sidebar-offcanvas">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="{{asset('assets/img/avatar3.png')}}" class="assets/img-circle" alt="User Image" />
				</div>
				<div class="pull-left info">
					<p>您好, {{isset($authedUser->name)?$authedUser->name:'游客'}}</p>

					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<!-- search form -->
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Search..."/>
					<span class="input-group-btn">
						<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu"> 
				<li class="active">
				<a href="{{url('admin/index')}}">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
				</li>

				<?php
				$rq_path	= trim(request()->path(), '/\\');
				$menu_active = substr($rq_path, 0, strpos($rq_path, '/', strpos($rq_path, '/')+1));
				?>

				@foreach (config('menus.admin') as $key=>$admin)
				@if(isset($admin['children']))
				<li class="treeview @if($menu_active == $key) active @endif">
				<a href="#">
					<i class="{{$admin['icon']}}"></i>
					<span>{{$admin['name']}}</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					@foreach ($admin['children'] as $subname=>$submenu)
					<li class="@if($rq_path==$submenu) active @endif"><a href="{{url($submenu)}}"><i class="fa fa-angle-double-right"></i> {{$subname}}</a></li>
					@endforeach
				</ul>
				</li>
				@else
				<li>
				<a href="{{url($admin['url'])}}">
					<i class="{{$admin['icon']}}"></i> <span>{{$admin['name']}}</span>
				</a>
				</li>
				@endif
				@endforeach
			</ul>
			</section>
			<!-- /.sidebar -->
			</aside>

			<!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			<h1>
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{url('admin/index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
				@foreach ($bdb as $bb)
				@if (isset($bb['url']))
				<li><a href="{{url($bb['url'])}}">{{$bb['name']}}</a></li>
				@else
				<li class="active">{{$bb['name']}}</li>
				@endif
				@endforeach
			</ol>
			</section>

			<!-- Main content -->
			<section class="content">

			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>出错了!</strong>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif

			@if (Session::has('success'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>
					<i class="fa fa-check-circle fa-lg fa-fw"></i> Success.
				</strong>
				{{ Session::get('success') }}
			</div>
			@endif

			@yield('content')
			</section><!-- /.content -->
			</aside><!-- /.right-side -->
		</div><!-- ./wrapper -->

		<!-- add new calendar event modal -->

		<!-- jQuery 2.0.2 -->
		<!-- jQuery UI 1.10.3 -->
		<script src="{{asset('assets/js/jquery-ui-1.10.3.min.js')}}" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<!-- Sparkline -->
		<script src="{{asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
		<!-- jvectormap -->
		<script src="{{asset('assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
		<!-- fullCalendar -->
		<script src="{{asset('assets/js/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
		<!-- jQuery Knob Chart -->
		<script src="{{asset('assets/js/plugins/jqueryKnob/jquery.knob.js')}}" type="text/javascript"></script>
		<!-- daterangepicker -->
		<script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="{{asset('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
		<!-- iCheck -->
		<!-- AdminLTE App -->
		<script src="{{asset('assets/js/AdminLTE/app.js')}}" type="text/javascript"></script>
	</body>
</html>
