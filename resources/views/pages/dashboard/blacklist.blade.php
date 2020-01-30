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
	      <a class="nav-item is-tab has-icon @if(str_contains( $currentPath, '/') ) is-active @endif ">Add domain</a>
	    </div>
	  </div>
	</nav>
@endsection


@section('content')
	
<section class="section">
	<div class="columns">
		<div class="column">
					
					@yield('sub-content')

		</div>
		
	</div>
</section>

@endsection