@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <h1>Vartotojo informacija</h1>
        <h2>{{$user->first_name}} {{$user->last_name}}</h2>
        <h2>{{$user->email}}</h2>
        <h3>Sukurtas: {{$user->created_at}}</h3>
        <x-alert/>
            <form method="post" action="{{route('admin.update',$user->id)}}">
                @csrf
                @method('patch')
                <input type="hidden" value="{{$user->first_name}}" name="first_name"/>
                <input type="hidden" value="{{$user->last_name}}" name="last_name"/>
                <input type="hidden" value="workaroundEmail@address.com" name="email"/>
                <div class="col">
                    <div class="row">
                        <div class="col-sm-3"> 
                            <label for="userlevel" class="form-label text-md-right"><b>{{ __('Kategorija') }}</b></label>
                            <select class="form-control @error('userlevel') is-invalid @enderror" name="userlevel" value="{{ old('userlevel') }}" id="userlevel">
                                <option value="{{Config::get('constants.KLIENTAS')}}" {{$user->userlevel == Config::get('constants.KLIENTAS') ? 'selected' : '' }}>{{Config::get('constants.KLIENTO_VARDAS')}}</option>
                                <option value="{{Config::get('constants.DARBUOTOJAS')}}" {{$user->userlevel == Config::get('constants.DARBUOTOJAS') ? 'selected' : '' }}>{{Config::get('constants.DARBUOTOJO_VARDAS')}}</option>
                                <option value="{{Config::get('constants.SANDELIO_VADOVAS')}}" {{$user->userlevel == Config::get('constants.SANDELIO_VADOVAS') ? 'selected' : '' }}>{{Config::get('constants.SAN_VAD_VARDAS')}}</option>
                                <option value="{{Config::get('constants.GAMYKLOS_VADOVAS')}}" {{$user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS') ? 'selected' : '' }}>{{Config::get('constants.GAM_VAD_VARDAS')}}</option>
                                <option value="{{Config::get('constants.ADMINISTRATORIUS')}}" {{$user->userlevel == Config::get('constants.ADMINISTRATORIUS') ? 'selected' : '' }}>{{Config::get('constants.ADMINISTRATORIAUS_VARDAS')}}</option>
                            </select>
                        </div>
                        <div class="col align-self-end">                  
                            <button type="submit"  class="btn btn-primary">
                                Pakeisti vartotojo kategoriją
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="post" action="{{route('admin.change_password',$user->id)}}">
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

            @if($user->userlevel == Config::get('constants.KLIENTAS'))
                <h1>pirkejas</h1>


            @endif
            @if($user->userlevel == Config::get('constants.DARBUOTOJAS'))
                <h1>darbuotojas</h1>


            @endif
            @if($user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
                <h1>gam_vad</h1>


            @endif
            @if($user->userlevel == Config::get('constants.SANDELIO_VADOVAS'))
                <h1>san_vad</h1>


            @endif


            <form style="display:none" id="{{'form-delete-'.$user->id}}" method="post" action="{{route('admin.destroy', $user->id)}}">
                        @csrf
                        @method('delete')
            </form> 
            <div class="card-footer">
                <button class="float-right btn btn-danger my-2" type="submit" onclick="event.preventDefault();if(confirm('Do you really want to delete this user?')){
                document.getElementById('form-delete-{{$user->id}}').submit()}">
                  Ištrinti vartotoją
                </button>
                <a class="float-left mr-2 btn btn-secondary my-2" href="{{route('admin.index')}}">
                  Atgal
                </a>
            </div>    
    </div>
</div>
@endsection