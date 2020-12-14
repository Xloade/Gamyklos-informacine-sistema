@extends('layouts.app')
@section('content')
@php($category = '')
@php($user = Auth::user())
@switch($user->userlevel)
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
        <h2>{{$user->first_name}} {{$user->last_name}}</h2>
        <h2>{{$user->email}}</h2>
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
        <!-- KLIENTAS-------------------------------------------------------------------------------------------------------- -->
        @if($user->userlevel == Config::get('constants.KLIENTAS'))
        <h2>Jūsų adreso duomenys</h2>
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card shadow border border-secondary">
                    <table class="table">
                        <tr>
                            <th>Šalis</th>
                            <td>{{$user->salis}}</td>
                        </tr>
                        <tr>
                            <th>Miestas</th>
                            <td>{{$user->miestas}}</td>
                        </tr>
                        <tr>
                            <th>Gatvė</th>
                            <td>{{$user->gatve}}</td>
                            </tr>
                        <tr>
                            <th>Buto nr.</th>
                            <td>{{$user->buto_nr}}</td>
                        </tr>
                        <tr>
                            <th>Durų kodas</th>
                            <td>{{$user->duru_kodas}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
            <form method="post" action="{{route('user.set_address')}}">
                @csrf
                @method('patch')
                <div class="form-group row">
                    <label for="salis" class="col-md-4 col-form-label text-md-right">{{ __('Įveskite šalį') }}</label>
                    <div class="col-md-8">
                        <input id="salis" type="text" value="{{!empty(old('salis')) ? old('salis') : $user->salis}}" class="form-control @error('salis') is-invalid @enderror" name="salis">
                        @error('salis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="miestas" class="col-md-4 col-form-label text-md-right">{{ __('Įveskite miestą') }}</label>
                    <div class="col-md-8">
                        <input id="miestas" type="text" value="{{!empty(old('miestas')) ? old('miestas') : $user->miestas}}" class="form-control @error('miestas') is-invalid @enderror" name="miestas">
                        @error('miestas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gatve" class="col-md-4 col-form-label text-md-right">{{ __('Įveskite gatvę') }}</label>
                    <div class="col-md-8">
                        <input id="gatve" type="text" value="{{!empty(old('gatve')) ? old('gatve') : $user->gatve}}" class="form-control @error('gatve') is-invalid @enderror" name="gatve">
                        @error('gatve')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="buto_nr" class="col-md-4 col-form-label text-md-right">{{ __('Įveskite buto nr.') }}</label>
                    <div class="col-md-8">
                        <input id="butas" type="text" value="{{!empty(old('buto_nr')) ? old('buto_nr') : $user->buto_nr}}" class="form-control @error('buto_nr') is-invalid @enderror" name="buto_nr">
                        @error('buto_nr')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="duru_kodas" class="col-md-4 col-form-label text-md-right">{{ __('Įveskite durų kodą (nebūtina)') }}</label>
                    <div class="col-md-8">
                        <input id="duru_kodas" type="text" value="{{!empty(old('duru_kodas')) ? old('duru_kodas') : $user->duru_kodas}}" class="form-control @error('salis') is-invalid @enderror" name="duru_kodas">
                        @error('duru_kodas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
            </div>
        </div>
        </div>
        @endif
        <!-- DARBUOTOJAS-------------------------------------------------------------------------------------------------------- -->
        @if($user->userlevel == Config::get('constants.DARBUOTOJAS'))
            @if(empty($gamykla))
                <h3>Šiuo metu darbuotojas nepriklauso jokiai gamyklai</h3>
            @else
                <h2>Darbuotojas dirba gamykloje: {{$gamykla->pavadinimas}}</h2>
                <h2>{{$gamykla->adresas}}</h2>
                @if(!empty($user->atlyginimas))
                    <h2>Darbuotojo atlyginimas: {{$user->atlyginimas}} Eur</h2>
                @else
                    <h4>Atlyginimas nenustatytas</h4>
                @endif
            @endif
        @endif
        <!-- GAM_VADOVAS-------------------------------------------------------------------------------------------------------- -->
        @if($user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
            @if(!empty($user->atlyginimas))
                <h2>Atlyginimas: {{$user->atlyginimas}} Eur</h2>
            @else
                <h4>Atlyginimas nenustatytas</h4>
            @endif
        @endif
        <!-- SAN-VADOVAS-------------------------------------------------------------------------------------------------------- -->
        @if($user->userlevel == Config::get('constants.SANDELIO_VADOVAS'))
            @if(!empty($user->atlyginimas))
                <h2>Atlyginimas: {{$user->atlyginimas}} Eur</h2>
            @else
                <h4>Atlyginimas nenustatytas</h4>
            @endif
        @endif
        <!--ADMINISTRATORIUS-------------------------------------------------------------------------------------------------------- -->
        @if($user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
            @if(!empty($user->atlyginimas))
                <h2>Atlyginimas: {{$user->atlyginimas}} Eur</h2>
            @else
                <h4>Atlyginimas nenustatytas</h4>
            @endif
        @endif
        <!----------------------------------------------------------------------------------------------------------------------- -->
        <div class="card-footer">
            <a class="float-left mr-2 btn btn-secondary my-2" href="{{route('home')}}">
                Atgal
            </a>
        </div>    
    </div>
</div>
@endsection