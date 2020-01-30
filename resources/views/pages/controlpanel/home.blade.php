@extends('layouts.controlpanelmaster')

@section('title', 'Dine kortlinks')


@section('hero-content')
	<h1 class="title">
        Kontrolpanel
  	</h1>
  	<h2 class="subtitle">Her kan du få et overblik over dine kortlinks</h2>

	
@endsection


@section('submenu')
	<nav class="nav has-shadow">
	  <div class="container">
	    <div class="nav-left">
	      <a class="nav-item is-tab @if($currentPath == '/') ) is-active @endif" href="{{route('controlpanel')}}">Dine kortlinks</a>
		  		<a class="nav-item is-tab @if(str_contains( $currentPath, 'shortlink-links') ) is-active @endif" href="{{route('controlpanelShortlinkLinks')}}">Kortlink links</a>
	    </div>
	  </div>
	</nav>
@endsection


@section('content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
				
				<h1 class="title">Dine Kortlinks</h1>
		        <table class="table">
		        	<thead>
		        		<tr>
		        			<th>
		        				@if($sortColumn == "shortlink_id" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel') . '?column=shortlink_id&sort='.'desc'}}">
		        						Kortlink <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "shortlink_id" && $sortOrder == "desc")
									<a href="{{route('controlpanel') . '?column=shortlink_id&sort='.'asc'}}">
		        						Kortlink <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel') . '?column=shortlink_id&sort='.'asc'}}">
		        						Kortlink <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "url" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel') . '?column=url&sort='.'desc'}}">
		        						URL <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "url" && $sortOrder == "desc")
									<a href="{{route('controlpanel') . '?column=url&sort='.'asc'}}">
		        						URL <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel') . '?column=url&sort='.'asc'}}">
		        						URL <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "created_at" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel') . '?column=created_at&sort='.'desc'}}">
		        						Oprettet <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "created_at" && $sortOrder == "desc")
									<a href="{{route('controlpanel') . '?column=created_at&sort='.'asc'}}">
		        						Oprettet <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel') . '?column=created_at&sort='.'asc'}}">
		        						Oprettet <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
		        				
	        				</th>
		        			<th>Handling</th>
		        		</tr>
		        	</thead>
		        	<tbody>							
						@forelse ($user_shortlinks as $shortlink)
						    <tr>
						    	<td>
						    		<a title="{{ route('home') }}/{{ $shortlink->shortlink_id }}" href="{{ route('home') }}/{{ $shortlink->shortlink_id }}">{{ str_limit(route('home'). '/'. $shortlink->shortlink_id, 20) }}</a>
					    		</td>
						    	<td>{{ str_limit($shortlink->url, 20) }}</td>
						    	<td>{{ $shortlink->created_at }}</td>

			    	    		<td class="is-icon">
			    		    		<a href="/shortlink/delete/{{ $shortlink->id }}" title="Slet" onclick="return confirm('Er du sikker?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
			    	    		</td>
						    </tr>
						@empty
							<tr>
								<td colspan="3">Du har ikke oprettet nogen kortlinks endnu. :(</td>
							</tr>
						@endforelse

		        	</tbody>	
		        </table>
		

			</div>
		</div>
	</div>
</section>

@endsection