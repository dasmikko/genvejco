@extends('layouts.dashmaster')

@section('title', 'Page Title')


@section('hero-content')
	<h1 class="title">
        Shortlink stats
  	</h1>
	<h2 class="subtitle">
		Statistics for the shortlink
	</h2>

	
@endsection



@section('content')
	
<section class="section">
	<div class="container">

		@if (session('success'))
		<div class="notification is-success">
          	{{ session('success') }}
        </div>
        @endif

        <h1 class="title">Viewing stats for: {{route('home').'/'.$shortlink->shortlink_id}}</h1>
	
		<div class="columns">
			<div class="column">			
				<div class="box">
					<h1 class="title">Views</h1>
					<h2 class="subtitle">Total views: {{$shortlink->shortlinkViews->count()}}</h2>	
					<table class="table is-striped">
						<thead>
							<tr>
								<th>IP</th>
								<th>Referer</th>
								<th>When</th>
							</tr>
						</thead>
						<tbody>	
							@forelse($shortlink->shortlinkViews as $view)
								<tr>
									<td>{{$view->ip}}</td>
									<td>{{$view->referer}}</td>
									<td>{{$view->created_at}}</td>
								</tr>
							@empty
								<tr>
									<td colspan="3">No views :(</td>
								</tr>
							@endforelse
						</tbody>
					</table>	
				</div>

			</div>

			<div class="column">

				<div class="box">
					<h1 class="title">Views by referer</h1>
					<h2 class="subtitle">Total referers: {{$refererlist->count()}}</h2>	

					<table class="table is-striped">
						<thead>
							<tr>
								<th>Referer</th>
								<th>Total views</th>
							</tr>
						</thead>
						<tbody>	
							@foreach($refererlist as $referer)

								<tr>
									<td>{{$referer->referer}}</td>
									<td>{{$referer->total}}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<canvas id="refererChart" width="100%" height="50"></canvas>

					<script>

						var colors = ['#F44336', '#4CAF50', '#1976D2', '#CDDC39', '#F57C00', '#FFC107']

						var mydata = {
							labels: [
								@foreach($refererlist as $referer)
									"{{$referer->referer}}",
								@endforeach
							],
							datasets: [{
								backgroundColor: colors,
								data: [
									@foreach($refererlist as $referer)
										"{{$referer->total}}",
									@endforeach
								]
							}]
						}

						var ctx = $("#refererChart");
						var myDoughnutChart = new Chart(ctx, {
						    type: 'doughnut',
						    data: mydata,
						    options: {
						        responsive: true,
						        maintainAspectRatio: true,
						    }
						});
					</script>
					

				</div>

			</div>
			
		</div>
	</div>
</section>

@endsection