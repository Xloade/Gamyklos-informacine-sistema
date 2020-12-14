@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Administratoriaus sąsaja</h2>
            <div class="d-flex flex-row-reverse">
                <div>
                    <a href="{{route('admin.create')}}" class="btn btn-default fas fas fa-plus"> Sukurti naują vartotoją</a>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.change_category') }}" method="get">
            <div class="form-group row">
                <label for="userlevel" class="col-md-4 col-form-label text-md-right"><b>{{ __('Kategorija') }}</b></label>
                <div class="col-md-6">
                    <div class="form-group">
                        <select onchange="this.form.submit()" class="form-control @error('userlevel') is-invalid @enderror" name="userlevel" value="{{ old('userlevel') }}" id="userlevel">
                        <option value="-1" {{$userlevel == -1 ? 'selected' : '' }}>Visi</option>
                        <option value="{{Config::get('constants.KLIENTAS')}}" {{$userlevel == Config::get('constants.KLIENTAS') ? 'selected' : '' }}>{{Config::get('constants.KLIENTO_VARDAS')}}</option>
                        <option value="{{Config::get('constants.DARBUOTOJAS')}}" {{$userlevel == Config::get('constants.DARBUOTOJAS') ? 'selected' : '' }}>{{Config::get('constants.DARBUOTOJO_VARDAS')}}</option>
                        <option value="{{Config::get('constants.SANDELIO_VADOVAS')}}" {{$userlevel == Config::get('constants.SANDELIO_VADOVAS') ? 'selected' : '' }}>{{Config::get('constants.SAN_VAD_VARDAS')}}</option>
                        <option value="{{Config::get('constants.GAMYKLOS_VADOVAS')}}" {{$userlevel == Config::get('constants.GAMYKLOS_VADOVAS') ? 'selected' : '' }}>{{Config::get('constants.GAM_VAD_VARDAS')}}</option>
                        <option value="{{Config::get('constants.ADMINISTRATORIUS')}}" {{$userlevel == Config::get('constants.ADMINISTRATORIUS') ? 'selected' : '' }}>{{Config::get('constants.ADMINISTRATORIAUS_VARDAS')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ route('admin.search') }}" method="get">
            <input type="hidden" name="userlevel" value="{{$userlevel}}">
            <div class="col">
                <div class="row">
                    <div class="col-sm-3"> 
                        <label for="date" class="form-label text-md-right"><b>{{ __('Paskyros sūkurimo data iki') }}</b></label>
                        <input class="form-control" type="date" id="date" name="date" value="{{ session()->has('user_search_date') ? session()->get('user_search_date') : Carbon\Carbon::now()->format('Y-m-d')}}" min="2020-01-01" max="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                    </div>
                    <div class="col-sm-3"> 
                        <label for="email" class="form-label text-md-right"><b>{{ __('E-paštas') }}</b></label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ session()->has('user_search_email') ? session()->get('user_search_email') : '' }}">
                    </div>
                    <div class="col align-self-end">                  
                        <button type="submit" name="search" id="search" class="btn btn-success search">
                            <i class="fas fa-search"> Ieškoti</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <x-alert/>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Vardas</th>
                        <th scope="col">E-paštas</th>
                        <th scope="col">Kategorija</th>
                        <th scope="col">Paskyra sukurta</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr class="text-center w-100">
                        <td scope="col">{{$user->first_name}} {{$user->last_name}}</td>
                        <td scope="col">{{$user->email}}</td>
                        @php($category = '')
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
                        <td scope="col">{{ $category}}</td>
                        <td scope="col">{{ $user->created_at}}</td>
                        @if($user->id != Auth::id())
                            <td scope="col"><a class="btn btn-success" href="{{route('admin.edit',$user->id)}}">Daugiau</a></td>
                            <td scope="col"><button class="btn btn-danger" onclick="event.preventDefault();if(confirm('Do you really want to delete this user?')){
                                        document.getElementById('form-delete-{{$user->id}}').submit()}">Ištrinti</button>
                            </td>
                            <form style="display:none" id="{{'form-delete-'.$user->id}}" method="post" action="{{route('admin.destroy', $user->id)}}">
                                    @csrf
                                    @method('delete')
                            </form> 
                        @else <td scope="col"></td><td scope="col"></td>
                        @endif                
                    </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>  
    </div>
</div>

<script>
    var full_width = false;
    function toggleWidth() {
        var doc = document.getElementById('app');
        var button = document.getElementById('expand-window');
        doc.classList.toggle('container');
        if (full_width)
            button.classList.toggle('fa-expand');
        else
            button.classList.toggle('fa-compress');
    }
</script>
@endsection