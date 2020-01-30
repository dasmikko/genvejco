@extends('layouts.controlpanelmaster')

@section('title', 'Dine kortlinks')


@section('hero-content')
	<h1 class="title">
        Kortlink links
  	</h1>
  	<h2 class="subtitle">Her kan du få et overblik over de kortlinks du forsøgte at lave</h2>

	
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
				
					<h1 class="title">Kortlink links</h1>
					<p>Her er alle de kortlinks, som du forsøgte at oprette, men en anden havde allerede brugt samme URL.</p>

			        <table class="table">
			        	<thead>
			        		<tr>
			        			<th>
		        				@if($sortColumn == "shortlink_id" && $sortOrder == "asc")
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_id&sort='.'desc'}}">
		        						Kortlink <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "shortlink_id" && $sortOrder == "desc")
									<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_id&sort='.'asc'}}">
		        						Kortlink <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_id&sort='.'asc'}}">
		        						Kortlink <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "shortlink_url" && $sortOrder == "asc")
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_url&sort='.'desc'}}">
		        						URL <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "shortlink_url" && $sortOrder == "desc")
									<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_url&sort='.'asc'}}">
		        						URL <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=shortlink_url&sort='.'asc'}}">
		        						URL <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "created_at" && $sortOrder == "asc")
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=created_at&sort='.'desc'}}">
		        						Oprettet <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "created_at" && $sortOrder == "desc")
									<a href="{{route('controlpanelShortlinkLinks') . '?column=created_at&sort='.'asc'}}">
		        						Oprettet <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanelShortlinkLinks') . '?column=created_at&sort='.'asc'}}">
		        						Oprettet <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
		        				
	        				</th>
			        			<th>Handling</th>
			        		</tr>
			        	</thead>
			        	<tbody>							
							@forelse  ($user_shortlinkLinks as $shortlink)
							    <tr>
							    	<td><a href="{{ route('home') }}/{{ $shortlink->shortlink_id }}">{{ route('home') }}/{{ $shortlink->shortlink_id }}</a></td>
							    	<td>{{ str_limit($shortlink->shortlink_url, 20) }}</td>
							    	<td>{{ $shortlink->created_at }}</td>

				    	    		<td class="is-icon">
				    		    		<a href="{{ route('shortlinklinkdelete', ['id' => $shortlink->id]) }}" title="Slet" onclick="return confirm('Er du sikker?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
				    	    		</td>
							    </tr>
							@empty
								<tr>
									<td colspan="3">Du har ikke nogen kortlink links</td>
								</tr>
							@endforelse

			        	</tbody>	
			        </table>

			</div>
		</div>
	</div>
</section>

@endsection