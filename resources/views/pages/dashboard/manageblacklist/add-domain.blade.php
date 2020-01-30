@extends('pages.dashboard.manageblacklist.blacklist')


@section('title', 'Add Domain')


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

		        <h1 class="title">Add domain to blacklist</h1>
		        <h2 class="subtitle">When adding domain, do not use www.</h2>

		       
		        {!! Form::open(['url' => '/manageblacklist/add']) !!}
			  		{!! Form::token() !!}

			  		{!! Form::label('domain', 'Domain', ['class' => 'label']); !!}
				    <p class="control has-icon">
				    	{!! Form::text('domain', '', ['class' => 'input is-medium', 'placeholder' => 'Domain to blacklist. Example: google.com']) !!}
				      	<i class="fa fa-globe"></i>
				    </p>
				    <p class="control">
				    	{!! Form::submit('Add domain to blacklist', ['class' => 'button is-primary']) !!}
				    	<a href="/manageblacklist" class="button is-link">Cancel</a>
				    </p>
			    {!! Form::close() !!}

			</div>
			
		</div>
	</div>
</section>

@endsection