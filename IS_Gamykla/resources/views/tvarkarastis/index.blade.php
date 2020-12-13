@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Tvarkaraščiai</h2>
            <div class="col">
                <form action="{{ action('TvarkarastisController@search') }}" method="get">
                    <div class="row">
                        <div class="col-sm-3"> 
                            <input class="form-control" type="date" id="date" name="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" max="2022-12-31">
                        </div>
                        <div class="col">                  
                            <button type="submit" class="btn btn-success search">
                                <i class="fas fa-search"> Ieškoti</i>
                            </button>
                        </div>
                    </div>
                </form>
                @if (Auth::user()->userlevel == Config::get('constants.ADMINISTRATORIUS') || Auth::user()->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
                <div class="container my-2">
                    <form action="{{ action('TvarkarastisController@create') }}" method="post">
                        <div class="row">
                                <div class="col">
                                    <select name="gamykla" id="gamykla" class="form-control">
                                        @if (Auth::user()->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                                            @foreach ($gamyklos as $gamykla)
                                                <option value="{{$gamykla->kodas}}">{{$gamykla->pavadinimas}}</option>
                                            @endforeach
                                        @endif
                                        @if (Auth::user()->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
                                            <option value="{{$gamyklos->kodas}}">{{$gamyklos->pavadinimas}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary fas fas fa-plus" type="submit" value="Ištrinti"> Sukurti tvarkaraštį</button>
                                    <input type="hidden" name="_method" value="post" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Nr</th>
                        <th scope="col">Data</th>
                        <th scope="col">Gamykla</th>
                        <th scope="col">Darbuotojas</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->userlevel != Config::get('constants.SANDELIO_VADOVAS')) 
                    @foreach ($tvarkarasciai as $tvarkarastis)
                    @php
                    $worker = $tvarkarastis->worker;
                    @endphp
                    <tr>
                    <td class="text-center">#{{$tvarkarastis->id}}</td>
                    <td class="text-center">{{$tvarkarastis->data}}</td>
                    <td class="text-center">{{$worker->gamykla->pavadinimas}}</td>
                    <td class="text-center">{{$worker->first_name}} {{$worker->last_name}}</td>
                    <td class="text-center">
                        <div>
                            <a class="btn btn-primary fas fa-eye" href="{{ action('TvarkarastisController@show', $tvarkarastis->id) }}">Peržiūrėti</a>
                        </div>
                    </td>
                    @if (Auth::user()->userlevel == Config::get('constants.ADMINISTRATORIUS') || Auth::user()->userlevel == Config::get('constants.GAMYKLOS_VADOVAS'))
                    <td class="text-center">
                        <div>
                            <a class="btn btn-success fa fa-edit" href="{{ action('TvarkarastisController@edit', $tvarkarastis->id) }}">Keisti</a>
                        </div>
                    </td>
                    <td class="text-center">
                        <div>
                            <form action="{{ action('TvarkarastisController@delete', ['id' =>  $tvarkarastis->id]) }}" method="post">
                                <button class="btn btn-danger fas fa-trash" type="submit" value="Ištrinti"> Ištrinti</button>
                                <input type="hidden" name="_method" value="delete" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>      
                    </td>
                    @endif
                </tr>
                    @endforeach
                    @endif   
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