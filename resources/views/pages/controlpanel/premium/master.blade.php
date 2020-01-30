@extends('layouts.controlpanelmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Kontrolpanel
  	</h1>
  	<h2 class="subtitle">Her kan du få et overblik over dine kortlinks</h2>

	
@endsection

@section('submenu')
	<nav class="nav has-shadow">
		<div class="container">
			<div class="nav-left">
		  		<a class="nav-item is-tab @if($currentPath == '/') ) is-active @endif" href="{{route('controlpanel')}}">Dine kortlinks</a>
		  		<a class="nav-item is-tab @if(str_contains( $currentPath, 'shortlink-links') ) is-active @endif" href="{{route('controlpanelShortlinkLinks')}}">Kortlink links</a>
			</div>
		</div>
	</nav>
@endsection



@section('content')
							
	@yield('sub-content')

@endsection