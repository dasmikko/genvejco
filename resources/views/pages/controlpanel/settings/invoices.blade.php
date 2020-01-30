@extends('pages.controlpanel.settings.master')

@section('title', 'Skift kortoplysninger')


@section('hero-content')
	<h1 class="title">
        Kvitteringer
  	</h1>
	<h2 class="subtitle">
		Her kan du alle dine kvitteringer
	</h2>

	
@endsection



@section('sub-content')
	
<section class="section">
	<div class="container">

		<div class="columns">
			<div class="column">

				<table class="table">
					<thead>
						<tr>
							<th colspan="2">Abonnement</th>
						</tr>
					</thead>
					<tbody>
				    @foreach (Auth::user()->invoices() as $invoice)
				        <tr>
				            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
				            <td><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
				        </tr>
				    @endforeach
				    </tbody>
				</table>

			</div>
		</div>

						
		


	</div>
</section>

@endsection