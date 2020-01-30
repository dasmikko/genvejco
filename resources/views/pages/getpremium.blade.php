@extends('layouts.master')

@section('title', 'Køb premium')

@section('head')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection





@section('hero-content')
	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				
				<h1 class="title">Køb premium</h1>

				<div class="box">
					@if (session('error'))
					<div class="notification is-danger">
			          	{{ session('error') }}
			        </div>
			        @endif

			       	@if(Auth::check())
			        {!! Form::open(['url' => '/buypremium']) !!}
				  		{!! Form::token() !!}

				  		

				  	

						<p>Når du opretter dig, acceptere du vores <a href="/terms" target="_blank">betingelser</a></p>
					    
						
					    <p class="control">
					    	<script
					  		    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					  		    data-key="{{env('STRIPE_KEY')}}"
					  		    data-amount="49995"
					  		    data-name="Genvej.co"
					  		    data-description="Køb premium"
					  		    data-image="http://genvej.co/img/app/icon.png"
					  		    data-locale="da"
					  		    data-label="Betal med kort"
					  		    data-description="Du er ved at købe et premium abbonement til 499,95 årligt."
					  		    data-zip-code="true"
					  		    data-billing-address="true"
					  		    data-currency="dkk">
				  		  	</script>
					    	<a href="{{ route('home') }}" class="button is-link">Annuller</a>
					    </p>
				    {!! Form::close() !!}
					@else
						<p>Du skal være logget ind for at kunne købe premium.</p>
					@endif

			    </div>

			</div>
			
		</div>
	</div>


@endsection