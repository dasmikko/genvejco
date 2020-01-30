@extends('pages.controlpanel.premium.master')

@section('title', 'Kortlink oversigt')


@section('hero-content')
	<h1 class="title">
        Kontrolpanel
  	</h1>
  	<h2 class="subtitle">Her kan du få et overblik over dine kortlinks</h2>

	
@endsection


@section('content')
	
<section class="section">
	<div class="container">

		<h1 class="title">Dine Kortlinks</h1>

		<table class="user-information-list">
			<tr>
				<td width="130">Antal kortlinks i alt:</td>
				<td><span class="boxed">{{ $user_shortlinks->total() }}</span></td>
			</tr>
		</table>
		
		<div class="columns">
			<div class="column">		
				
		        <table class="table">
		        	<thead>
		        		<tr>
		        			<th>
		        				@if($sortColumn == "shortlink_id" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel', ['column' => 'shortlink_id', 'sort' => 'desc', 'page' => $paginationPage] )}}">
		        						Kortlink <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "shortlink_id" && $sortOrder == "desc")
									<a href="{{route('controlpanel', ['column' => 'shortlink_id', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Kortlink <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel', ['column' => 'shortlink_id', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Kortlink <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "url" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel', ['column' => 'url', 'sort' => 'desc', 'page' => $paginationPage])}}">
		        						URL <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "url" && $sortOrder == "desc")
									<a href="{{route('controlpanel', ['column' => 'url', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						URL <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel', ['column' => 'url', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						URL <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
							<th>
		        				@if($sortColumn == "url" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel', ['column' => 'shortlink_views_count', 'sort' => 'desc', 'page' => $paginationPage])}}">
		        						Visninger <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "url" && $sortOrder == "desc")
									<a href="{{route('controlpanel', ['column' => 'shortlink_views_count', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Visgniner <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel', ['column' => 'shortlink_views_count', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Visninger <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
	        				</th>
		        			<th>
		        				@if($sortColumn == "created_at" && $sortOrder == "asc")
		        					<a href="{{route('controlpanel', ['column' => 'created_at', 'sort' => 'desc', 'page' => $paginationPage])}}">
		        						Oprettet <i class="fa fa-sort-desc" aria-hidden="true"></i>
		        					</a>
		        				@elseif($sortColumn == "created_at" && $sortOrder == "desc")
									<a href="{{route('controlpanel', ['column' => 'created_at', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Oprettet <i class="fa fa-sort-asc" aria-hidden="true"></i>
		        					</a>
		        				@else
		        					<a href="{{route('controlpanel', ['column' => 'created_at', 'sort' => 'asc', 'page' => $paginationPage])}}">
		        						Oprettet <i class="fa fa-sort" aria-hidden="true"></i>
		        					</a>
		        				@endif
		        				
	        				</th>
		        			<th colspan="2">Handling</th>
		        		</tr>
		        	</thead>
		        	<tbody>							
						@forelse ($user_shortlinks as $shortlink)
						    <tr>
						    	<td>
						    		<a title="{{ route('home') }}/{{ $shortlink->shortlink_id }}" href="{{ route('home') }}/{{ $shortlink->shortlink_id }}">{{ str_limit(route('home'). '/'. $shortlink->shortlink_id, 20) }}</a>
					    		</td>
						    	<td>{{ str_limit($shortlink->url, 20) }}</td>
						    	<td>{{ $shortlink->shortlink_views_count }}</td>
						    	<td>{{ $shortlink->created_at }}</td>

			    	    		<td class="is-icon">
			    		    		<a href="/shortlink/delete/{{ $shortlink->id }}" title="Slet" onclick="return confirm('Er du sikker?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
			    	    		</td>

			    	    		<td class="is-icon">
						    		<a href="{{ route('userViewShortlinkStats', ['id' => $shortlink->id ]) }}" title="Se statistik"><i class="fa fa-area-chart" aria-hidden="true"></i></a>
					    		</td>
						    </tr>
						@empty
							<tr>
								<td colspan="3">Du har ikke oprettet nogen kortlinks endnu. :(</td>
							</tr>
						@endforelse

		        	</tbody>	
		        </table>

		        {{ $user_shortlinks->appends(['column' => $sortColumn, 'sort' => $sortOrder])->links() }}

			</div>
		</div>
	</div>
</section>

@endsection