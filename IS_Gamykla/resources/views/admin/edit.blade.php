@extends('layouts.app')

@section('content')
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
        <h1>Vartotojo informacija</h1>
        <h2>{{$user->first_name}} {{$user->last_name}}</h2>
        <h2>{{$user->email}}</h2>
        <h3>Sukurtas: {{$user->created_at}}</h3>
        <h3>{{$category}}</h3>
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
<!--PIRKEJAS---------------------------------------------------------------------------------------------------------------------->
            @if($user->userlevel == Config::get('constants.KLIENTAS'))
                <h1>pirkejas</h1>


            @endif
<!--DARBUOTOJAS---------------------------------------------------------------------------------------------------------------------->
            @if($user->userlevel == Config::get('constants.DARBUOTOJAS'))
                @if(empty($gamykla))
                    <h3>Šiuo metu darbuotojas nepriklauso jokiai gamyklai</h3>
                @else
                    <h2>Darbuotojas dirba gamykloje: {{$gamykla->pavadinimas}}</h2>
                    <h2>{{$gamykla->adresas}}</h2>
                @endif
                <h2>Darbuotojo atlyginimas: {{$user->atlyginimas}} Eur</h2>
                <form method="post" action="{{route('admin.change_worker_info',$user->id)}}">
                    @csrf
                    @method('patch')
                    <div class="col">
                        <div class="row">
                            <div class="col-sm-3"> 
                                <label for="darbuotojo_gamykla" class="form-label text-md-right"><b>{{ __('Priskirti gamyklą') }}</b></label>
                                <select class="form-control @error('darbuotojo_gamykla') is-invalid @enderror" name="darbuotojo_gamykla" value="{{ old('darbuotojo_gamykla') }}" id="darbuotojo_gamykla">
                                    @foreach($visosGamyklos as $gam)
                                    <option value="{{$gam->kodas}}" {{$user->fk_gamykla == $gam->kodas ? 'selected' : '' }}>{{$gam->pavadinimas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3"> 
                                <label for="atlyginimas" class="form-label text-md-right"><b>{{ __('Atlyginimas, Eur') }}</b></label>
                                <div class="">
                                    <input id="atlyginimas" value="{{$user->atlyginimas}}" type="number" class="form-control @error('atlyginimas') is-invalid @enderror" name="atlyginimas">
                                    @error('atlyginimas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </select>
                            </div>
                            <div class="col align-self-end">                  
                                <button type="submit"  class="btn btn-primary">
                                    Pakeisti darbuotojo duomenis
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
<!--GAMYKLOS_VADOVAS---------------------------------------------------------------------------------------------------------------------->
            @if($user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
                @if(empty($gamykla))
                    <h3>Šiuo metu gamyklos vadovas neturi gamyklos</h3>
                @else
                <h2>Gamyklos vadovo gamykla: {{$gamykla->pavadinimas}}</h2>
                <h2>{{$gamykla->adresas}}</h2>
                <h1>Gamyklos darbuotojai</h1>
                <table class="table table-hover table-striped  p-0 m-0">
                    <thead>
                        <tr class="text-center w-100">
                            <th scope="col">Vardas</th>
                            <th scope="col">E-paštas</th>
                            <th scope="col">Paskyra sukurta</th>
                            <th scope="col">Atlyginimas</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach($gamyklosDarbuotojai as $darbuotojas)
                        <tr class="text-center w-100">
                            <td scope="col">{{$darbuotojas->first_name}} {{$darbuotojas->last_name}}</td>
                            <td scope="col">{{$darbuotojas->email}}</td>
                            <td scope="col">{{$darbuotojas->created_at}}</td>
                            <td scope="col">{{$darbuotojas->atlyginimas}}</td>                
                            <td scope="col"><a class="btn btn-success" href="{{route('admin.edit',$darbuotojas->id)}}">Daugiau</a></td>
                            <td scope="col"><button class="btn btn-danger" onclick="event.preventDefault();if(confirm('Do you really want to delete this user?')){
                                        document.getElementById('form-delete-{{$user->id}}').submit()}">Ištrinti</button>
                            </td>
                            <form style="display:none" id="{{'form-delete-'.$darbuotojas->id}}" method="post" action="{{route('admin.destroy', $darbuotojas->id)}}">
                                    @csrf
                                    @method('delete')
                            </form>               
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                    <form method="post" action="{{route('admin.change_gam_vad_info',$user->id)}}">
                    @csrf
                    @method('patch') 
                        <div class="col">
                            <div class="row">
                                <div class="col-sm-3"> 
                                    <label for="gamyklos_vadovas" class="form-label text-md-right"><b>{{ __('Keisti gamyklos vadovą') }}</b></label>
                                    <select class="form-control @error('gamyklos_vadovas') is-invalid @enderror" name="gamyklos_vadovas" value="{{ old('gamyklos_vadovas') }}" id="darbuotojo_gamykla">
                                        @foreach($visiVadovai as $vadovas)
                                        <option value="{{$vadovas->id}}" {{$user->id == $vadovas->id ? 'selected' : '' }}>{{$vadovas->first_name}} {{$vadovas->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col align-self-end">                  
                                    <button type="submit"  class="btn btn-primary">
                                        Pakeisti gamyklos vadovą
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            @endif
<!--SANDELIO_VADOVAS---------------------------------------------------------------------------------------------------------------------->
            @if($user->userlevel == Config::get('constants.SANDELIO_VADOVAS'))
                <h1>Priklausantys sandėliai</h1>
                <table class="table table-hover table-striped  p-0 m-0">
                    <thead>
                        <tr class="text-center w-100">
                            <th scope="col">Kodas</th>
                            <th scope="col">Šalis</th>
                            <th scope="col">Miestas</th>
                            <th scope="col">Gatvė</th>
                            <th scope="col">Talpa</th>
                            <th scope="col">Prekės sandelyje</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach($sandeliai as $sandelis)
                                <tr>
                                    <td class="text-center">#{{ $sandelis->sandelio_kodas }}</td>
                                    <td class="text-center">{{ $sandelis->salis }}</td>
                                    <td class="text-center">{{ $sandelis->miestas }}</td>
                                    <td class="text-center">{{ $sandelis->gatve }}</td>
                                    <td class="text-center">{{ $sandelis->talpa }} m&#x00B3</td>
                                    <td class="text-center">
                                        <div>
                                            <form action="{{ action('PrekesSandelyjeController@index', $sandelis->sandelio_kodas) }}" method="get">
                                                <button class="btn btn-info fas fa-eye" type="submit" value="Keisti"> Peržiūrėti prekes</button>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <a href="{{ action('SandelisController@edit', $sandelis->sandelio_kodas) }}" class="btn btn-success fa fa-edit">Keisti</a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <form action="{{ action('SandelisController@delete') }}" method="post">
                                                <button class="btn btn-danger fas fa-trash" type="submit"> Ištrinti</button>
                                                <input type="hidden" name="_method" value="delete" />
                                                <input type="hidden" name="id" value="{{ $sandelis->sandelio_kodas }}" />
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>

            @endif

<!--------------------------------------------------------------------------------------------------------------------------------------------------->
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