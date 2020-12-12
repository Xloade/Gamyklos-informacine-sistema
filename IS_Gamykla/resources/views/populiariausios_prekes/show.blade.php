@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Populiariausios prekės</h2>
            <div class="col">
                <div class="row">
                    <div class="col-sm-3"> 
                        <input class="form-control" type="date" id="date_from" name="date_from" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="1990-01-01" max="2022-12-31">
                    </div>
                    <div class="col-sm-3"> 
                        <input class="form-control" type="date" id="date_to" name="date_to" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="1990-01-01" max="2022-12-31">
                    </div>
                    <div class="col">                  
                        <button type="button" name="calc" id="calc" class="btn btn-success search">
                            <i class="fas fa-chart-bar"> Apskaičiuoti</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Kodas</th>
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Kaina</th>
                        <th scope="col">Data nuo</th>
                        <th scope="col">Data iki</th>
                        <th scope="col">Parduotų prekių kiekis</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prekes as $preke)
                        <tr>
                            <td class="text-center">#{{ $preke->prekes_kodas }}</td>
                            <td class="text-center">{{ $preke->pavadinimas }}</td>
                            <td class="text-center">{{ $preke->kaina }}€</td>
                            <td class="text-center">{{ $preke->nuo }}</td>
                            <td class="text-center">{{ $preke->iki }}</td>
                            <td class="text-center">{{ $preke->kiekis }}</td>
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