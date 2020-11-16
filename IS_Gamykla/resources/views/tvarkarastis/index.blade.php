@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Tvarkaraščiai</h2>
            <div class="col">
                <div class="row">
                    <div class="col-sm-3"> 
                        <input class="form-control" type="date" id="date" name="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" max="2022-12-31">
                    </div>
                    <div class="col">                  
                        <button type="button" name="search" id="search" class="btn btn-success search">
                            <i class="fas fa-search"> Ieškoti</i>
                        </button>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse">
                    <form action="{{ action('TvarkarastisController@create') }}" method="get">
                        <button class="btn btn-default fas fas fa-plus" type="submit" value="Sukurti"> Sukurti tvarkaraštį</button>
                        <input type="hidden" name="_method" value="create" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Nr</th>
                        <th scope="col">Data</th>
                        <th scope="col">Gamykla</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">#1</td>
                        <td class="text-center">{{ Carbon\Carbon::now()->format('Y-m-d') }}</td>
                        <td class="text-center">Varžtinė</td>
                        <td class="text-center">
                            <div>
                                <form action="{{ action('TvarkarastisController@show', '1') }}" method="get">
                                    <button class="btn btn-default fas fa-eye" type="submit" value="Perziureti"> Peržiūrėti</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <div>
                                <form action="{{ action('TvarkarastisController@edit', '1') }}" method="get">
                                    <button class="btn btn-default fas fa-edit" type="submit" value="Keisti"> Keisti</button>
                                </form>
                            </div>
                        </td>
                        <td class="text-center">
                            <div>
                                <form action="{{ action('TvarkarastisController@delete', ['id' => '1']) }}" method="post">
                                    <button class="btn btn-default fas fa-trash" type="submit" value="Ištrinti"> Ištrinti</button>
                                    <input type="hidden" name="_method" value="delete" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>      
                        </td>
                    </tr>
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