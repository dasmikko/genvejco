@extends('layouts.controlpanelmaster')

@section('title', 'Indstillinger')


@section('hero-content')
	<h1 class="title">
        Indstillinger
  	</h1>
	<h2 class="subtitle">
		Her kan du ændre dine informationer
	</h2>

	
@endsection

@section('submenu')
	<nav class="nav has-shadow">
	  <div class="container">
	    <div class="nav-left">
	    	<a href="{{ route('controlpanelSettings') }}" class="nav-item is-tab has-icon @if($currentPath == 'settings') ) is-active @endif ">Oversigt</a>
	      	<a href="{{ route('controlpanelSettingsEmail') }}" class="nav-item is-tab has-icon @if(str_contains( $currentPath, 'email') ) is-active @endif ">Skift e-mail</a>
	      	<a href="{{ route('controlpanelSettingsPassword') }}" class="nav-item is-tab has-icon @if(str_contains( $currentPath, 'password') ) is-active @endif ">Skift kodeord</a>
	    </div>
	  </div>
	</nav>
@endsection



@section('content')
							
	@yield('sub-content')

@endsection