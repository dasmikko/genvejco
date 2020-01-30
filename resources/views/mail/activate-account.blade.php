<a href="{{route('home')}}"><img src="{{ route('home')}}/img/logo-email.png" alt="genvej.co - De bedste kortlinks!"></a>

<h1>Vi er der næsten!</h1>

<p>Vi mangler bare lige at du bekræfter din email.</p>

<p style="margin: 25px 0;"><a style="background: #00d1b2; padding: 10px 20px; border-radius: 2px; color: #ffffff; text-decoration: none;" href="{{ route('activateAccount', ['token' => $activationToken ]) }}">Bekræft!</a></p>

<p>Skulle det ske, at det ikke er dig, som har oprettet dig hos os, skal du blot se bort fra denne mail.</p>

<p>- Genvej.co Teamet</p>
