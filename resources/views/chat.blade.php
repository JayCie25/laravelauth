@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand btn btn-success" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="btn btn-primary mx-1" href="/firstpage">Personal Inv</a>
        <a class="btn btn-primary mx-1" href="/firstpage2">Public Inv</a>
        <a class="btn btn-primary mx-1" href="/posts">Posts</a>
        <a class="btn btn-primary mx-1" href="/chat">Chat</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-item disabled">
                        <h4>{{ __('Manage Account') }}</h4>
                        </div>
                        <div class="dropdown-item disabled text-dark">{{ Auth::user()->email }}</div>
                        <hr>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                        
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col text-center"></div>
        <div class="col text-center form-inline">
            <h4 class="mt-2 mb-3 bg-success rounded">{{ session('msg') }}</h4><h4 class="mt-2 mb-3 bg-warning rounded">{{ session('msgs') }}</h4><h4 class="mt-2 mb-3 bg-danger rounded">{{ session('msgss') }}</h4>
        </div>
        <div class="col">
            
        </div>
    </div>
    
    <hr class="tablehr">
    
        <div class="row" style="background: radial-gradient(ellipse at center, #8DBFDD 0%, #2B4C7C 100%)">
            <div class="col-md-4 p-2">
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach($users as $user)
                            <li class="user text-light mb-1" style="background-color: #678DC4; opacity: 90%;" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
                                @if($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        <img src="{{ $user->avatar }}" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8 p-2" id="messages">

            </div>
        </div>
    </div>
@endsection
