@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Manage shortlinks
  	</h1>
	<h2 class="subtitle">
		Edit, delete or whatever. ( ͡° ͜ʖ ͡°)
	</h2>

	
@endsection



@section('content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
						
						@if (session('success'))
						<div class="notification is-success">
				          	{{ session('success') }}
				        </div>
				        @endif

				        <h1 class="title">All shortlinks</h1>
						
				        

				        <table class="table is-striped">
				        	<thead>
				        		<tr>
				        			<th>Shortlink</th>
				        			<th>URL</th>
				        			<th>
				        				@if($sortColumn == "shortlink_views_count" && $sortOrder == "asc")
				        					<a href="{{route('manageShortlinks') . '?column=shortlink_views_count&sort='.'desc'}}">
				        						Views <i class="fa fa-angle-up" aria-hidden="true"></i>
				        					</a>
				        				@else 
											<a href="{{route('manageShortlinks') . '?column=shortlink_views_count&sort='.'asc'}}">
				        						Views <i class="fa fa-angle-down" aria-hidden="true"></i>
				        					</a>
				        				@endif
			        				</th>
				        			<th>
				        				@if($sortColumn == "created_at" && $sortOrder == "asc")
				        					<a href="{{route('manageShortlinks') . '?column=created_at&sort='.'desc'}}">
				        						Created at <i class="fa fa-angle-up" aria-hidden="true"></i>
				        					</a>
				        				@else 
											<a href="{{route('manageShortlinks') . '?column=created_at&sort='.'asc'}}">
				        						Created at <i class="fa fa-angle-down" aria-hidden="true"></i>
				        					</a>
				        				@endif
			        				</th>
				        			<th>
				        				User
			        				</th>
				        			<th colspan="4"></th>
				        		</tr>
				        	</thead>
				        	<tbody>							
								@foreach ($shortlinks as $shortlink)
								    <tr>
								    	<td>
								    		<a href="{{ route('home').'/'.$shortlink->shortlink_id }}">
								    			{{ route('home').'/'.$shortlink->shortlink_id }}
							    			</a>
							    		</td>
								    	<td alt="{{ $shortlink->url }}">{{ str_limit($shortlink->url, 20) }}</td>
								    	<td>{{ $shortlink->shortlinkViews->count() }}</td>
								    	<td>{{ $shortlink->created_at }}</td>

								    	@if($shortlink->user == "")
											<td>Anonymous</td>
								    	@else
											<td><a href="{{ route('edituserpage', ['id' => $shortlink->user->id])}}">{{ $shortlink->user->username }}</a></td>
								    	@endif
								    	

							    		<td class="is-icon">
								    		<a href="/manageshortlinks/delete/{{ $shortlink->id }}" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
							    		</td>

							    		<td class="is-icon">
								    		<a href="{{ $shortlink->url }}" target="_blank" title="View link"><i class="fa fa-external-link" aria-hidden="true"></i></a>
							    		</td>


										<td class="is-icon">
								    		<a href="{{ route('viewshortlinkstats', ['id' => $shortlink->id ]) }}" title="View stats"><i class="fa fa-area-chart" aria-hidden="true"></i></a>
							    		</td>

							    		


								    </tr>
								@endforeach

				        	</tbody>	
				        </table>

			</div>
			
		</div>
	</div>
</section>

@endsection