@extends('pages.dashboard.manageblacklist.blacklist')

@section('title', 'Manage blacklist')


@section('sub-content')
	
<section class="section">
	<div class="container">
		<div class="columns">
			<div class="column">
						
				@if (session('success'))
				<div class="notification is-success">
		          	{{ session('success') }}
		        </div>
		        @endif

		        <h1 class="title">All blacklisted domains</h1>

		       
		        <table class="table is-striped">
		        	<thead>
		        		<tr>
		        			<th>Domain</th>
		        			<th colspan="2"></th>
		        		</tr>
		        	</thead>
		        	<tbody>							
						@foreach ($blacklist_items as $item)
						    <tr>
						    	<td>{{ $item->domain }}</td>
						    	
					    		<td class="is-icon">
						    		<a href="/manageblacklist/delete/{{ $item->id }}" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
					    		</td>

					    		<td class="is-icon">
						    		<a href="{{ $item->url }}" target="_blank" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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