@extends('layouts.master')

@section('title', 'Genvej.co - De bedste og nemmeste kortlinks!')


@section('hero-content')
	<div class="columns">
		<div class="column is-half is-offset-one-quarter has-text-centered">
			
			<div class="box">
				
				@if (count($errors) > 0)
					@foreach ($errors->all() as $error)
					<div class="notification is-danger">
					  {{ $error }}
					</div>
					@endforeach
				@endif

				@if (session('shortlink-error'))
					<div class="notification is-danger">
					  {{ session('shortlink-error') }}
					</div>
				@endif


				@if (session('status-error'))
					<div class="notification is-danger">
					  {{ session('status-error') }}
					</div>
				@endif


				@if (session('status-message'))
					<div class="notification is-success">
					  {{ session('status-message') }}
					</div>
				@endif

				@if (session('success'))
					<div class="notification is-success">
					  {{ session('success') }}
					</div>
				@endif


				@if (session('status'))
				    <div class="notification is-success">

				  
				  		<p>{{ session('status') }} <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></p>
					    
					    @if(session('shortlink_id'))
					    	<p style="margin-top: 10px;"><a id="theshortlink" href="/{{ session('shortlink_id')  }}"><span class="tag  is-large">genvej.co/{{ session('shortlink_id') }}</span></a></p>

					    	<p style="margin-top: 10px;">
					    		<a class="button is-white is-inverted is-outlined copytoclipholder" data-clipboard-text="http://genvej.co/{{ session('shortlink_id') }}">
					    			<span class="icon">
					    				<i class="fa fa-clipboard" aria-hidden="true"></i>
					    			</span>
					    			<span>
					    				Kopier kortlink
					    			</span>
					    		</a>
				    		</p>
				    	@endif
					</div>

				@endif


				<article>
					
					<div class="media-content">
					  	<div class="content">
					  	{!! Form::open(['url' => '/']) !!}
					  		{!! Form::token() !!}
						    <p class="control has-icon">
						    	{!! Form::text('url', '', ['class' => 'input is-medium', 'placeholder' => 'Indtast din laaaange url her.']) !!}
						      	<i class="fa fa-globe"></i>
						    </p>
							
							@if(Auth::check()) 
								<p class="control">
									{!! Form::checkbox('own_custom_id', '', false, ['id' => "own_custom_id"]); !!}
									{!! Form::label('own_custom_id', 'Eget kortlink navn', ['class' => 'checkbox',]) !!}
								</p>

								<p class="control has-icon own_shortlink_container" style="display: none;">
									{!! Form::text('custom_id', '', ['class' => 'input is-medium', 'placeholder' => 'Indtast ønsket navn på kortlink.']) !!}
								  	<i class="fa fa-link"></i>
								  	<span class="help">Bemærk: Dit kortlink navn skal være på minimum 5 tegn, og kan ikke indeholde specialtegn eller mellemrum.<br>Hvis du ikke udfylder dette felt, laver vi et navn til dig link.</span>

								</p>
							@endif


						    <p class="control">
						    	{!! Form::submit('Generer kortlink!', ['class' => 'button is-primary is-fullwidth']) !!}
						    </p>
					    {!! Form::close() !!}
					  	</div>
					</div>


				</article>
			</div>
			
			<span class="tag"><p>Nu du generer et kortlink, accepterer du vores <a href="/terms">betingelser.</a></p></span>
			


		</div>
	</div>
	
@endsection

