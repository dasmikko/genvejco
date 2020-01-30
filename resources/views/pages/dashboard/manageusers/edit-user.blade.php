@extends('pages.dashboard.manageusers.master')


@section('title', 'Edit User')


@section('sub-content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column is-half">
					
				@if (count($errors) > 0)
					@foreach ($errors->all() as $error)
						<div class="notification is-danger">
						  {{ $error }}
						</div>
					@endforeach
				@endif

		        <h1 class="title">Edit User</h1>

		       
		        {!! Form::open(['url' => '/manageusers/update/'.$user->id]) !!}
			  		{!! Form::token() !!}

			  		{!! Form::label('username', 'Username'); !!}
				    <p class="control">
				    	{!! Form::text('username', $user->username, ['class' => 'input is-medium', 'placeholder' => 'Username']) !!}
				    </p>
					
					{!! Form::label('email', 'E-mail'); !!}
					<p class="control">
				    	{!! Form::email('email', $user->email, ['class' => 'input is-medium', 'placeholder' => 'E-mail']) !!}
				    </p>
					

					{!! Form::label('password', 'Password'); !!}
					<p class="control">
				    	{!! Form::password('password', ['class' => 'input is-medium', 'placeholder' => 'Password. Leave empty to not update it!']) !!}
				    </p>

				    {!! Form::label('active', 'Is activated', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::select('active', [0 => 'No', 1 => 'Yes'], $user->active); !!}
				    	</span>
				    </p>

				    {!! Form::label('role', 'Role', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::select('role', [1 => 'Admin', 2 => 'User', 3 => "Premium User"], $user->role); !!}
				    	</span>
				    </p>

				    {!! Form::label('max_custom_links', 'Max custom links', ['class' => 'label']); !!}
				    <p class="control">
				    	<span class="select is-medium is-expanded">
				    		{!! Form::text('max_custom_links', $user->max_custom_links, ['class' => 'input']); !!}
				    	</span>
				    </p>


				    <p class="control">
				    	{!! Form::submit('Update user', ['class' => 'button is-primary']) !!}
				    	<a href="/manageusers" class="button is-link">Cancel</a>
				    </p>
			    {!! Form::close() !!}

			</div>
			
		</div>
	</div>
</section>

@endsection