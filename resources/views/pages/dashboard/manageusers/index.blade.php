@extends('pages.dashboard.manageusers.master')


@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Manage users
  	</h1>
	<h2 class="subtitle">
		Create, Edit, delete or whatever. ( ͡° ͜ʖ ͡°)
	</h2>

	
@endsection



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

				        <h1 class="title">Users</h1>

				        

				        <table class="table is-striped">
				        	<thead>
				        		<tr>
				        			<th>Username</th>
				        			<th>E-mail</th>
				        			<th>Is activated</th>
				        			<th>Role</th>
				        			<th>Created at</th>
				        			<th colspan="2"></th>
				        		</tr>
				        	</thead>
				        	<tbody>							
								@foreach ($users as $user)
								    <tr>
								    	<td>{{ $user->username }}</td>
								    	<td>{{ $user->email}}</td>
								    	
					    		    	@if($user->active == 1)
					    		    		<td>Yes</td>
					    		    	@else
											<td>No</td>
					    		    	@endif
							    	

								    	@if($user->role == 1)
								    		<td>Admin</td>
								    	@elseif($user->role == 2)
											<td>User</td>
								    	@elseif($user->role == 3)
											<td>Premium User</td>
								    	@endif

								    	<td>{{ $user->created_at }}</td>
								    	
	
										<td class="is-icon">
								    		<a href="/manageusers/edit/{{ $user->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></a>
							    		</td>

							    		<td class="is-icon">
								    		<a href="/manageusers/delete/{{ $user->id }}" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a></a>
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