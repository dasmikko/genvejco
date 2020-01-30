@extends('layouts.master')

@section('title', 'Bliv medlem')





@section('hero-content')
	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				
				<h1 class="title">Bliv medlem</h1>

				<div class="box">
					@if (session('error'))
					<div class="notification is-danger">
			          	{{ session('error') }}
			        </div>
			        @endif

			       
			        {!! Form::open(['url' => '/register']) !!}
				  		{!! Form::token() !!}

				  		{!! Form::label('username', 'Brugernavn', ['class' => 'label']); !!}
					    <p class="control has-icon">
							@if (count($errors->get('username')) > 0)
					    		{!! Form::text('username', '', ['class' => 'input is-medium is-half is-danger ', 'placeholder' => 'Indtast ønskede brugenavn']) !!}
					    	@else 
								{!! Form::text('username', '', ['class' => 'input is-medium is-half ', 'placeholder' => 'Indtast ønskede brugenavn']) !!}
					    	@endif
					      	<i class="fa fa-user"></i>
					      	@if (count($errors->get('username')) > 0)
					      		@foreach ($errors->get('username') as $message)
					      		    <span class="help is-danger">{{ $message }}</span>
					      		@endforeach
					      	@endif
					    </p>




				  		{!! Form::label('email', 'Email adresse', ['class' => 'label']); !!}
					    <p class="control has-icon">

					    	@if (count($errors->get('email')) > 0)
					    		{!! Form::text('email', '', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast din email']) !!}
					    	@else 
								{!! Form::text('email', '', ['class' => 'input is-medium is-half', 'placeholder' => 'Indtast din email']) !!}
					    	@endif
					    	
					      	<i class="fa fa-envelope"></i>

					      	@if (count($errors->get('email')) > 0)
					      		@foreach ($errors->get('email') as $message)
					      		    <span class="help is-danger">{{ $message }}</span>
					      		@endforeach
					      	@endif
					    </p>


					    {!! Form::label('password', 'Kodeord', ['class' => 'label']); !!}
					    <p class="control has-icon">

					    	@if (count($errors->get('password')) > 0)
					    		{!! Form::password('password', ['class' => 'input is-medium is-half is-danger', 'placeholder' => 'Indtast kodeord']) !!}
					    	@else 
								{!! Form::password('password', ['class' => 'input is-medium is-half', 'placeholder' => 'Indtast kodeord']) !!}
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


						
						{!! Form::label('capthca', 'Bevis du er et menneske', ['class' => 'label']); !!}
						<p class="control">
							<div class="g-recaptcha" data-sitekey="6LfPEwsUAAAAAEd6UYfFdQQkB8sdlNijbsfgU2I_"></div>
						</p>

						<p>Når du opretter dig, acceptere du vores <a href="/terms" target="_blank">betingelser</a></p>
					    

					    <p class="control">
					    	{!! Form::submit('Opret', ['class' => 'button is-primary']) !!}
					    	<a href="{{ route('home') }}" class="button is-link">Annuller</a>
					    </p>
				    {!! Form::close() !!}

			    </div>

			</div>
			
		</div>
	</div>


@endsection