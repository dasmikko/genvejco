@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Manage users
  	</h1>
	<h2 class="subtitle">
		Create, Edit, delete or whatever. ( ͡° ͜ʖ ͡°)
	</h2>

	
@endsection



@section('submenu')
	<nav class="nav has-shadow">
	  <div class="container">
	    <div class="nav-left">
			<a href="/manageusers" class="nav-item is-tab has-icon @if($currentPath == "manageusers") ) is-active @endif ">Users</a>
	      	<a href="/manageusers/add" class="nav-item is-tab has-icon @if(str_contains( $currentPath, 'add') ) is-active @endif ">Add User</a>
	    </div>
	  </div>
	</nav>
@endsection


@section('content')				
	@yield('sub-content')
@endsection