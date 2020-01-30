@extends('layouts.master')

@section('title', 'Glemt kodeord')

@section('hero-content')
	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				
				<h1 class="title">Glemt kodeord</h1>

				<div class="box">
					@if (session('error'))
					<div class="notification is-danger">
			          	{{ session('error') }}
			        </div>
			        @endif

			        <p>Hvis du har glemt dit kodeord, kan du skrive din e-mail nedenfor, og vi sender dig et link til at skifte det.</p>

			       
			        {!! Form::open(['url' => '/forgotpassword']) !!}
				  		{!! Form::token() !!}

				  		{!! Form::label('email', 'Din e-mail', ['class' => 'label']) !!}
					    <p class="control has-icon">
							@if (count($errors->get('username')) > 0)
					    		{!! Form::text('email', '', ['class' => 'input is-medium is-half is-danger ', 'placeholder' => 'Indtast din e-mail']) !!}
					    	@else 
								{!! Form::text('email', '', ['class' => 'input is-medium is-half ', 'placeholder' => 'Indtast din e-mail']) !!}
					    	@endif
					      	<i class="fa fa-user"></i>
					      	@if (count($errors->get('email')) > 0)
					      		@foreach ($errors->get('email') as $message)
					      		    <span class="help is-danger">{{ $message }}</span>
					      		@endforeach
					      	@endif
					    </p>
					    

					    <p class="control">
					    	{!! Form::submit('Nustil kodeord', ['class' => 'button is-primary']) !!}
					    	<a href="{{ route('home') }}" class="button is-link">Annuller</a>
					    </p>
				    {!! Form::close() !!}

			    </div>

			</div>
			
		</div>
	</div>


@endsection