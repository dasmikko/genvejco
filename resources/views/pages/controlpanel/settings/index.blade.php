@extends('pages.controlpanel.settings.master')

@section('title', 'Indstillinger')


@section('hero-content')
	<h1 class="title">
        Indstillinger
  	</h1>
	<h2 class="subtitle">
		Her kan du ændre dine informationer
	</h2>

	
@endsection



@section('sub-content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
				
				@if (session('success'))
				<div class="notification is-success">
		          	{{ session('success') }}
		        </div>
		        @endif
				
				<h1 class="title">Dine Informationer</h1>

				<table class="user-information-list">
					<tr>
						<td width="140">E-mail:</td>
						<td><span class="boxed">{{ Auth::user()->email }}</span></td>
					</tr>
					<tr>
						<td>Konto type:</td>
						@if(Auth::user()->role == 1)
							<td><span class="boxed is-admin">Administrator</span></td>
						@elseif(Auth::user()->role == 2)
							<td><span class="boxed is-user">Medlem</span></td>
						@elseif(Auth::user()->role == 3)
							<td><span class="boxed is-premium">Premium bruger</span></td>
						@endif
					</tr>
					<tr>
						<td>API key:</td>
						<td><span class="boxed is-premium">{{ Auth::user()->apitoken }}</span> <a href="/generateapikey">Make API Key</a></td>
					</tr>
					<tr>
						<td>Medlem siden:</td>
						<td><span class="boxed">{{ Auth::user()->created_at }}</span></td>
					</tr>
				</table>
							
			</div>
		</div>
	</div>
</section>

@endsection