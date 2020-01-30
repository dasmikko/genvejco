@extends('layouts.master')

@section('title', 'Tak!')




@section('hero-content')
	

	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				<h1 class="title">Tak!</h1>
				<div class="box">
						
					<p>Tusind tak for at tilmelde Genvej.co <strong>Premium</strong></p>
					<p>Du har nu adgang til alle premium features, direkte fra kontrolpanelet.</p>
					
					<p><a href="{{route('controlpanel')}}" class="button is-primary">Gå til kontrolpanel</a></p>


				</div>

			</div>
			
		</div>
	</div>

@endsection