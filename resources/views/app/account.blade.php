@extends('base')


@section('title', 'profil')

@section('content')
    <h1> Votre profil</h1>
    <div class="">
        @auth
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
            <form class="" action="{{ route('auth.logout') }}" method="post">
                @method("delete")
                @csrf
                <button class="">Se déconnecter</button>
            </form>
        @endauth
        @guest
            <a href="{{ route('auth.login') }}">Se connecter</a>
        @endguest
    </div>

@endsection
