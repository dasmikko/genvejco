@extends('pages.controlpanel.settings.master')

@section('title', 'Skift e-mail')


@section('hero-content')
	<h1 class="title">
        Skift e-mail
  	</h1>
	<h2 class="subtitle">
		Her kan du skifte e-mail
	</h2>

	
@endsection



@section('sub-content')
	
<section class="section">
	<div class="container">

		<div class="columns">
			<div class="column is-half">

				{!! Form::open(['url' => '/settings/email']) !!}
			  		{!! Form::token() !!}

			  		{!! Form::label('email', 'Nye e-mail', ['class' => 'label']); !!}
				    <p class="control has-icon">
				    	
						
						@if (count($errors->get('email')) > 0)
				    		{!! Form::text('email', '', ['class' => 'input is-medium is-half is-danger ', 'placeholder' => 'Indtast din nye email.']) !!}
				    	@else 
							{!! Form::text('email', '', ['class' => 'input is-medium is-half ', 'placeholder' => 'Indtast din nye email.']) !!}
				    	@endif
				      	<i class="fa fa-globe"></i>
				      	@if (count($errors->get('email')) > 0)
				      		@foreach ($errors->get('email') as $message)
				      		    <span class="help is-danger">{{ $message }}</span>
				      		@endforeach
				      	@endif
				    </p>

			  		{!! Form::label('email-check', 'Gentag e-mail', ['class' => 'label']); !!}
				    <p class="control has-icon">

				    	@if (count($errors->get('email-check')) > 0)
				    		{!! Form::text('email-check', '', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast din nye email igen.']) !!}
				    	@else 
							{!! Form::text('email-check', '', ['class' => 'input is-medium is-half', 'placeholder' => 'Indtast din nye email igen.']) !!}
				    	@endif
				    	
				      	<i class="fa fa-globe"></i>

				      	@if (count($errors->get('email-check')) > 0)
				      		@foreach ($errors->get('email-check') as $message)
				      		    <span class="help is-danger">{{ $message }}</span>
				      		@endforeach
				      	@endif
				    </p>

				    <p class="control">
				    	{!! Form::submit('Skift email', ['class' => 'button is-primary']) !!}
				    	<a href="{{ route('controlpanelSettings') }}" class="button is-link">Annuller</a>
				    </p>
			    {!! Form::close() !!}

			</div>
		</div>

						
		


	</div>
</section>

@endsection