@extends('layouts.errormaster')

@section('title', 'Genvej.co - Kortlink ikke fundet!')


@section('hero-content')
    <div class="columns">
        <div class="column is-offset-one-quarter is-half content">
            <h1 class="title">Ups!</h1>
            <div class="box">
                <p>Det kortlink du søgte kunne desværre ikke findes. :(</p>
                <p>Dette kan muligvis skyldes at det er blevet slettet, eller der var fejl i linket.</p>
                <p>Du er velkommen til at oprette flere kortlink hos os!</p>
                <p><a href="{{route('home')}}" class="button is-primary is-outlined">Opret kortlinks</a></p>
            </div>
            

        </div>
    </div>
    
@endsection

