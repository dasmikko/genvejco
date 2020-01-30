@extends('pages.controlpanel.settings.master')

@section('title', 'Skift kodeord')


@section('hero-content')
	<h1 class="title">
        Skift kodeord
  	</h1>
	<h2 class="subtitle">
		Her kan du skifte dit kodeord
	</h2>

	
@endsection



@section('sub-content')
	
<section class="section">
	<div class="container">

		<div class="columns">
			<div class="column is-half">

				{!! Form::open(['url' => '/settings/password']) !!}
			  		{!! Form::token() !!}

			  		{!! Form::label('password', 'Nye kodeord', ['class' => 'label']); !!}
				    <p class="control has-icon">
						@if (count($errors->get('password')) > 0)
				    		{!! Form::password('password', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast dit nye kodeord']) !!}
				    	@else 
							{!! Form::password('password', ['class' => 'input is-medium is-half ', 'placeholder' => 'Indtast dit nye kodeord.']) !!}
				    	@endif
				      	<i class="fa fa-globe"></i>
				      	@if (count($errors->get('password')) > 0)
				      		@foreach ($errors->get('password') as $message)
				      		    <span class="help is-danger">{{ $message }}</span>
				      		@endforeach
				      	@endif
				    </p>

			  		{!! Form::label('password-check', 'Gentag kodeord', ['class' => 'label']); !!}
				    <p class="control has-icon">

				    	@if (count($errors->get('password-check')) > 0)
				    		{!! Form::password('password-check', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast dit nye kodeord igen']) !!}
				    	@else 
							{!! Form::password('password-check', ['class' => 'input is-medium is-half', 'placeholder' => 'Indtast dit nye password igen']) !!}
				    	@endif
				    	
				      	<i class="fa fa-globe"></i>

				      	@if (count($errors->get('password-check')) > 0)
				      		@foreach ($errors->get('password-check') as $message)
				      		    <span class="help is-danger">{{ $message }}</span>
				      		@endforeach
				      	@endif
				    </p>

				    <p class="control">
				    	{!! Form::submit('Skift kodeord', ['class' => 'button is-primary']) !!}
				    	<a href="{{ route('controlpanelSettings') }}" class="button is-link">Annuller</a>
				    </p>
			    {!! Form::close() !!}

			</div>
		</div>

						
		


	</div>
</section>

@endsection