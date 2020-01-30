@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Login
  	</h1>
	<h2 class="subtitle">
		You need to login to continue
	</h2>

	
@endsection



@section('content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-half">
						
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

			  		{!! Form::label('username', 'Username'); !!}
				    <p class="control">
				    	{!! Form::text('username', '', ['class' => 'input is-medium', 'placeholder' => 'Username']) !!}
				    </p>
					

					{!! Form::label('password', 'Password'); !!}
					<p class="control">
				    	{!! Form::password('password', ['class' => 'input is-medium', 'placeholder' => 'Password']) !!}
				    </p>
	
				    <p class="control">
				    	{!! Form::submit('Login', ['class' => 'button is-primary']) !!}
				    </p>
			    {!! Form::close() !!}

			</div>
			
		</div>
	</div>
</section>

@endsection