<a href="{{route('home')}}"><img src="{{ route('home')}}/img/logo-email.png" alt="genvej.co - De bedste kortlinks!"></a>

<h1>Nustil kodeord</h1>

<p>Der er blevet andmoding en nulstilling af kodeord.</p>

<p>Hvis det ikke er dig, skal du blot se bort fra denne mail.</p>

<p style="margin: 25px 0;"><a style="background: #00d1b2; padding: 10px 20px; border-radius: 2px; color: #ffffff; text-decoration: none;" href="{{ route('resetpassword', ['token' => $resetPasswordToken	 ]) }}">Nulstil kodeord!</a></p>

<p>Bemærk at nulstillings linket er kun gyldig i 12 timer.</p>

<p>- Genvej.co Teamet</p>
