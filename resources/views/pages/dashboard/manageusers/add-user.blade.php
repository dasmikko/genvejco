@extends('pages.dashboard.manageusers.master')


@section('title', 'Add User')


@section('sub-content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-half">
						
				@if (session('success'))
				<div class="notification is-success">
		          	{{ session('success') }}
		        </div>
		        @endif

		        <h1 class="title">Add User</h1>

		       
		        {!! Form::open(['url' => '/manageusers/add']) !!}
			  		{!! Form::token() !!}

			  		{!! Form::label('username', 'Username', ['class' => 'label']); !!}
				    <p class="control">
				    	{!! Form::text('username', '', ['class' => 'input is-medium', 'placeholder' => 'Username']) !!}
				    </p>
					
					{!! Form::label('email', 'E-mail', ['class' => 'label']); !!}
					<p class="control">
				    	{!! Form::email('email', '', ['class' => 'input is-medium', 'placeholder' => 'E-mail']) !!}
				    </p>
					

					{!! Form::label('password', 'Password', ['class' => 'label']); !!}
					<p class="control">
				    	{!! Form::password('password', ['class' => 'input is-medium', 'placeholder' => 'Password']) !!}
				    </p>

				    {!! Form::label('active', 'Is activated', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::select('active', [0 => 'No', 1 => 'Yes'], 0); !!}
				    	</span>
				    </p>

	
					{!! Form::label('role', 'Role', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::select('role', [1 => 'Admin', 2 => 'User', 3 => "Premium User"], 2); !!}
				    	</span>
				    </p>

				    {!! Form::label('max_custom_links', 'Max custom links', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::text('max_custom_links', '5', ['class' => 'input']); !!}
				    	</span>
				    </p>


				    <p class="control">
				    	{!! Form::submit('Create user', ['class' => 'button is-primary']) !!}
				    	<a href="/manageusers" class="button is-link">Cancel</a>
				    </p>
			    {!! Form::close() !!}

			</div>
			
		</div>
	</div>
</section>

@endsection