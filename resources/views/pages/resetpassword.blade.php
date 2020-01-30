@extends('layouts.master')

@section('title', 'Nulstil kodeord')

@section('hero-content')
	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				
				<h1 class="title">Nulstil kodeord</h1>

				<div class="box">
					@if (session('error'))
					<div class="notification is-danger">
			          	{{ session('error') }}
			        </div>
			        @endif

			       
			        {!! Form::open(['url' => ['/resetpassword', $token] ]) !!}
				  		{!! Form::token() !!}

				  		{!! Form::label('password', 'Kodeord', ['class' => 'label']); !!}
					    <p class="control has-icon">

					    	@if (count($errors->get('password')) > 0)
					    		{!! Form::password('password', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast det nye kodeord']) !!}
					    	@else 
								{!! Form::password('password', ['class' => 'input is-medium is-half', 'placeholder' => 'Indtast det nye kodeord']) !!}
					    	@endif
					    	
					      	<i class="fa fa-key"></i>

					      	@if (count($errors->get('password')) > 0)
					      		@foreach ($errors->get('password') as $message)
					      		    <span class="help is-danger">{{ $message }}</span>
					      		@endforeach
					      	@endif
					    </p>

					    {!! Form::label('password-check', 'Gentag kodeord', ['class' => 'label']); !!}
					    <p class="control has-icon">

					    	@if (count($errors->get('password-check')) > 0)
					    		{!! Form::password('password-check', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Gentag kodeord']) !!}
					    	@else 
								{!! Form::password('password-check', ['class' => 'input is-medium is-half', 'placeholder' => 'Gentag kodeord']) !!}
					    	@endif
					    	
					      	<i class="fa fa-key"></i>

					      	@if (count($errors->get('password-check')) > 0)
					      		@foreach ($errors->get('password-check') as $message)
					      		    <span class="help is-danger">{{ $message }}</span>
					      		@endforeach
					      	@endif
					    </p>
					    

					    <p class="control">
					    	{!! Form::submit('Skift kodeord', ['class' => 'button is-primary']) !!}
					    	<a href="{{ route('home') }}" class="button is-link">Annuller</a>
					    </p>
				    {!! Form::close() !!}

			    </div>

			</div>
			
		</div>
	</div>


@endsection