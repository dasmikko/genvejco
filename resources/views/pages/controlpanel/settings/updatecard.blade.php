@extends('pages.controlpanel.settings.master')

@section('title', 'Skift kortoplysninger')


@section('hero-content')
	<h1 class="title">
        Opdater kortoplysninger
  	</h1>
	<h2 class="subtitle">
		Her kan du skifte dine kortoplysninger
	</h2>

	
@endsection



@section('sub-content')
	
<section class="section">
	<div class="container">

		<div class="columns">
			<div class="column is-half">

				{!! Form::open(['url' => '/settings/updatecard']) !!}
				  		{!! Form::token() !!}
					   	<p class="control">Her kan du skifte dine kortoplysninger.</p>
					    <p class="control">

				  		  	<script
				  		  	  src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				  		  	  data-key="{{env('STRIPE_KEY')}}"
				  		  	  data-image="http://genvej.co/img/app/icon.png"
				  		  	  data-name="Genvej.co"
				  		  	  data-panel-label="Opdatér kortoplysninger"
				  		  	  data-label="Opdatér kortoplysninger"
				  		  	  data-allow-remember-me=false
				  		  	  data-locale="da">
				  		  	  </script>
					    	<a href="{{ route('controlpanelSettings') }}" class="button is-link">Annuller</a>
					    </p>
				    {!! Form::close() !!}

			</div>
		</div>

						
		


	</div>
</section>

@endsection