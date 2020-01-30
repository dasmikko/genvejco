@extends('layouts.master')

@section('title', 'Premium')




@section('hero-content')
	

	

	<div class="container">
		<div class="columns">
			<div class="column is-offset-one-quarter is-half content">
				<h1 class="title">Køb Premium</h1>
				<div class="box">
						
					<p>Er du glad for at de kortlinks vi laver, men mangler statistik and andre features?</p>
					<p>Så køb premium! Med premium får du følgende:</p>
					<ul>
						<li>Ubegrænset mængde navngivet kortlinks.</li>
						<li>
							Mulighed for statistik på alle dine kortlinks.
							<ul>
								<li>Se hvilken browser/styresystem folk benytter.</li>
								<li>Se hvor folk kommer fra.</li>
							</ul>
						</li>
						<li>Omdøbning af dine kortlinks.</li>
						<li>Ned til 3 tegn på navngivet kortlinks.</li>
						<li>Nye features gratis!</li>
					</ul>

					<p>Alt dette for lille pris <span class="boxed is-inline is-price">499 DKK</span> årligt.</p>
					<p>Pris er inklusiv moms.</p>

					<p><a href="{{ route('buypremium')}}" class="button is-success is-large">Køb premium</a></p>

				</div>

			</div>
			
		</div>
	</div>

@endsection