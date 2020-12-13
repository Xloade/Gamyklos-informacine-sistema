@extends('layouts.app')
@section('content')
@php($category = '')
@switch(Auth::user()->userlevel)
    @case(Config::get('constants.KLIENTAS'))
        @php($category = Config::get('constants.KLIENTO_VARDAS'))
        @break
    @case(Config::get('constants.DARBUOTOJAS'))
        @php($category = Config::get('constants.DARBUOTOJO_VARDAS'))
        @break
    @case(Config::get('constants.SANDELIO_VADOVAS'))
        @php($category = Config::get('constants.SAN_VAD_VARDAS'))
        @break
    @case(Config::get('constants.GAMYKLOS_VADOVAS'))
        @php($category = Config::get('constants.GAM_VAD_VARDAS'))
        @break
    @case(Config::get('constants.ADMINISTRATORIUS'))
        @php($category = Config::get('constants.ADMINISTRATORIAUS_VARDAS'))
        @break
    @default
        @php($category = 'undefined')
@endswitch
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <h1>Profilio informacija</h1>
        <h2>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
        <h2>{{Auth::user()->email}}</h2>
        <h3>Jūs esate {{$category}}</h3>
        <x-alert/>
        <form method="post" action="{{route('user.change_password')}}">
                @csrf
                @method('patch')
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Naujas slaptažodis') }}</label>
                    <div class="">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Pakartoti slaptažodį') }}</label>
                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Keisti slaptažodį') }}
                        </button>
                    </div>
                </div>
            </form>
        <div class="card-footer">
            <a class="float-left mr-2 btn btn-secondary my-2" href="{{route('home')}}">
                Atgal
            </a>
        </div>    
    </div>
</div>
@endsection