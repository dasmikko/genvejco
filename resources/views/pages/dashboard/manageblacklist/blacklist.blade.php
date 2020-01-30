@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Blacklist
  	</h1>
	<h2 class="subtitle">
		Blacklisted domains
	</h2>

	
@endsection


@section('submenu')
	<nav class="nav has-shadow">
	  <div class="container">
	    <div class="nav-left">
			<a href="/manageblacklist" class="nav-item is-tab has-icon @if($currentPath == "manageblacklist") ) is-active @endif ">Domains</a>
	      	<a href="/manageblacklist/add" class="nav-item is-tab has-icon @if(str_contains( $currentPath, 'add') ) is-active @endif ">Add domain</a>
	    </div>
	  </div>
	</nav>
@endsection


@section('content')				
	@yield('sub-content')
@endsection