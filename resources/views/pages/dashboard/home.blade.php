@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Dashboard
  	</h1>
	<h2 class="subtitle">
		Stats and shitz :^)
	</h2>

	
@endsection


@section('submenu')
	<nav class="nav has-shadow">
	  <div class="container">
	    <div class="nav-left">
	      <a class="nav-item is-tab is-active">Shortlink stats</a>
	      <a class="nav-item is-tab">User stats</a>
	    </div>
	  </div>
	</nav>
@endsection


@section('content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">

				<div class="box">
				  <article class="media">

				    <div class="media-content">
				      <div class="content">
				        <p><strong>Popular shortlinks</strong></p>

				        <table class="table">
				        	<thead>
				        		<tr>
				        			<th>Shortlink id</th>
				        			<th>URL</th>
				        			<th>Views</th>
				        			<th>Created at</th>
				        		</tr>
				        	</thead>
				        	<tbody>							
								@foreach ($popularShortlinks as $shortlink)
								    <tr>
								    	<td>{{ $shortlink->shortlink->shortlink_id }}</td>
								    	<td title="{{ $shortlink->shortlink->url }}">{{ str_limit($shortlink->shortlink->url, 20) }}</td>
								    	<td>{{ $shortlink->views }}</td>
								    	<td>{{ $shortlink->created_at }}</td>
								    </tr>
								@endforeach

				        	</tbody>	
				        </table>

				      </div>
				    </div>
				  </article>
				</div>

			</div>
			<div class="column">
				
				<div class="box">
				  <article class="media">

				    <div class="media-content">
				      <div class="content">
				        <p><strong>Latest shortlinks</strong></p>

				        <table class="table">
				        	<thead>
				        		<tr>
				        			<th>URL</th>
				        			<th>Views</th>
				        			<th>Created at</th>
				        		</tr>
				        	</thead>
				        	<tbody>							
								@foreach ($latestShortlinks as $shortlink)
								    <tr>
								    	<td title="{{ $shortlink->url }}">{{ str_limit($shortlink->url, 20)}}</td>
								    	<td>{{ $shortlink->shortlinkViews->count() }}</td>
								    	<td>{{ $shortlink->created_at }}</td>
								    </tr>
								@endforeach

				        	</tbody>	
				        </table>

				      </div>
				    </div>
				  </article>
				</div>


			</div>
		</div>
	</div>
</section>

@endsection