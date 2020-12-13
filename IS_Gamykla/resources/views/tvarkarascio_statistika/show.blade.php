@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Tvarkaraščio statistika</h2>
            <form action="{{ route('tvarkarascio_statistika.search') }}" method="get">
                <div class="col">
                    <div class="row">
                        <div class="col-sm-3"> 
                            <input class="form-control" type="date" id="date_from" name="date_from" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="1990-01-01" max="2022-12-31">
                        </div>
                        <div class="col-sm-3"> 
                            <input class="form-control" type="date" id="date_to" name="date_to" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="1990-01-01" max="2022-12-31">
                        </div>
                        <div class="col">                  
                            <button type="submit" name="search" id="search" class="btn btn-success search">
                                <i class="fas fa-chart-bar"> Apskaičiuoti</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Gamykla</th>
                        <th scope="col">Data nuo</th>
                        <th scope="col">Data iki</th>
                        <th scope="col">Darbo Valandos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gamyklos as $gamykla)
                        <tr>
                            <td class="text-center">{{ $gamykla->pavadinimas }}</td>
                            <td class="text-center">{{ $gamykla->nuo }}</td>
                            <td class="text-center">{{ $gamykla->iki }}</td>
                            <td class="text-center">{{ $gamykla->valandos }}</td>
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