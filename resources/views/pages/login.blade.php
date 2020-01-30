@extends('layouts.master')

@section('title', 'Log ind')




@section('hero-content')
	

	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				
				<h1 class="title">Log ind</h1>

				<div class="box">		
					@if (session('success'))
					<div class="notification is-success">
			          	{{ session('success') }}
			        </div>
			        @endif

			        @if (session('error'))
					<div class="notification is-danger">
			          	{{ session('error') }}
			        </div>
			        @endif
					

			       
			        {!! Form::open(['url' => '/login']) !!}
				  		{!! Form::token() !!}

				  		{!! Form::label('username', 'Brugernavn'); !!}
					    <p class="control">
					    	{!! Form::text('username', '', ['class' => 'input is-medium', 'placeholder' => 'Brugernavn']) !!}
					    </p>
						

						{!! Form::label('password', 'Password'); !!}
						<p class="control">
					    	{!! Form::password('password', ['class' => 'input is-medium', 'placeholder' => 'Password']) !!}
					    </p>
		
					    <p class="control">
					    	{!! Form::submit('Log ind', ['class' => 'button is-primary']) !!}
					    	<a href="{{ route('forgotpassword') }}" class="button is-link" href="/">Glemt kodeord</a>
					    </p>
				    {!! Form::close() !!}
				</div>
			</div>
			
		</div>
	</div>
</div>

@endsection