@extends('pages.controlpanel.premium.master')

@section('title', 'Kortlink statistik')



@section('content')
	
<section class="section">
	<div class="container">

		@if (session('success'))
		<div class="notification is-success">
          	{{ session('success') }}
        </div>
        @endif

        <h1 class="title">Statistik for</h1>
        <h2 class="subtitle">{{route('home').'/'.$shortlink->shortlink_id}}</h2>
	
		<div class="columns">
			<div class="column is-half">			
				<div class="box">
					<h1 class="title">Visninger</h1>
					<h2 class="subtitle">Visninger i alt: {{$shortlink->shortlink_views_count}}</h2>	
					

					@if($refererlist->count() > 0)

					<canvas id="viewsChart" height="100"></canvas>

					<script>
						var colors = ['#F44336', '#4CAF50', '#1976D2', '#CDDC39', '#F57C00', '#FFC107','#F44336', '#4CAF50', '#1976D2', '#CDDC39', '#F57C00', '#FFC107']

						var mydata = {
							labels: ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"],
							datasets: [{
								label: 'Visninger',
								backgroundColor: colors,
								data: [
									@foreach($viewsData as $month)
										"{{$month}}",
									@endforeach
								]
							}]
						}


						var ctx = $("#viewsChart");
						var myDoughnutChart = new Chart(ctx, {
						    type: 'bar',
						    data: mydata,
						    options: {
						        responsive: true,
						        maintainAspectRatio: true,
						        tooltips: {
						        	displayColors: true,
						        }
						    }
						});
					</script>

					@endif

					<table class="table is-striped">
						<thead>
							<tr>
								<th>Henvisning</th>
								<th>Dato</th>
							</tr>
						</thead>
						<tbody>	
							@forelse($viewsList as $view)
								<tr>
									<td>{{$view->referer}}</td>
									<td>{{$view->created_at}}</td>
								</tr>
							@empty
								<tr>
									<td colspan="2">Ingen visninger desværre :(</td>
								</tr>
							@endforelse
						</tbody>
					</table>

					{{ $viewsList->links() }}
				</div>

			</div>

			<div class="column is-half">

				<div class="box">
					<h1 class="title">Visninger pr. henvisning</h1>
					<h2 class="subtitle">Forskellige henvisninger i alt: {{$refererlist->count()}}</h2>	

					<table class="table is-striped">
						<thead>
							<tr>
								<th>Referer</th>
								<th>Visninger</th>
							</tr>
						</thead>
						<tbody>	
							@forelse($refererlist as $referer)

								<tr>
									<td>
										@if($referer->referer == "Direct")
											Direkte eller e-mail
										@else
											{{$referer->referer}}
									 	@endif
									</td>
									<td>{{$referer->total}}</td>
								</tr>
							@empty
								<tr>
									<td colspan="2">Ingen henvisninger desværre :(</td>
								</tr>
							@endforelse
						</tbody>
					</table>


					@if($refererlist->count() > 0)
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
					@endif

				</div>

			</div> {{-- Column end --}}

			<div class="column">
				<div class="box">
					<h1 class="title">Browsere</h1>
				</div>
			</div>
			
		</div> 


		<div class="columns">
			
		</div>
	</div>
</section>

@endsection