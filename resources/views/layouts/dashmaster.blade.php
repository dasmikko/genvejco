<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="theme-color" content="#00d1b2">
	<link rel="icon" sizes="192x192" href="/img/app/icon.png">
	<link rel="manifest" href="manifest.json">
	<title>Genvej.co - Dashboard - @yield('title')</title>
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.13/clipboard.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="/js/jquery-3.1.1.min.js"></script>
	<script src="/js/Chart.min.js"></script>
	<script src="/js/app.js"></script>
</head>
<body>


	<section class="hero is-primary">
		<!-- Hero header: will stick at the top -->
		<div class="hero-head">
			<header class="nav">
				<div class="container">
					<div class="nav-left">
						<a href="{{ route('home') }}" class="nav-item is-brand">
							<img src="/img/logo.png" alt="Genvej.co">
						</a>
					</div>
					<span class="nav-toggle">
						<span></span>
						<span></span>
						<span></span>
					</span>
					<div class="nav-right nav-menu">

						@if(Auth::check())
						<a href="logout" class="nav-item">
							Logout
						</a>

						<span class="nav-item">
							<a class="button is-primary is-inverted">
								<span class="icon"><i class="fa fa-user-circle-o"></i></span>
								<span>{{ Auth::user()->username }}</span>
							</a>
						</span>
						@endif


					</div>
				</div>
			</header>
		</div>

		<!-- Hero content: will be in the middle -->
		<div class="hero-body">
			<div class="container">
		  		@yield('hero-content')
			</div>
		</div>
		
		@if (Auth::check())

		  	<!-- Hero footer: will stick at the bottom -->
			<div class="hero-foot">
				<div class="container">
					<nav class="tabs is-boxed">
						<ul>
							<li @if($currentPath == "/") class="is-active" @endif ><a href="{{ route('dashboard')}}">Dashboard</a></li>
							<li @if(str_contains( $currentPath, "manageshortlinks") ) class="is-active" @endif><a href="/manageshortlinks">Manage shortlinks</a></li>
							<li @if(str_contains( $currentPath, "manageblacklist") ) class="is-active" @endif><a href="/manageblacklist">Manage blacklist</a></li>
							<li @if(str_contains( $currentPath, "manageusers") ) class="is-active" @endif><a href="/manageusers">Manage Users</a></li>
						</ul>
					</nav>
				</div>
			</div>

		@endif
	</section>

	@yield('submenu')
	
	@yield('content')

	<footer class="footer">
	  <div class="container">
	    <div class="content has-text-centered">
	      <p>
	        <strong>Genvej.co</strong> by Mikkel Anker Andersen & Jesper Holm
	      </p>
	      <p>{{ env('SYSTEM_VERSION')}}</p>
	    </div>
	  </div>
	</footer>
	
	
</body>
</html>