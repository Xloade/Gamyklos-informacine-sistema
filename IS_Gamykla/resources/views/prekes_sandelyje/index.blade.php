@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Prekės sandelyje</h2>
            <div class="d-flex flex-row-reverse">
                <div>
                    <a href="{{ action('PrekesSandelyjeController@create') }}" class="btn btn-info fa fa-plus">Užsakyti prekę</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Kodas</th>
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Kiekis sandelyje</th>
                        <th scope="col">Kaina</th>
                        <th scope="col">Svoris (kg)</th>
                        <th scope="col">Aukštis (cm)</th>
                        <th scope="col">Ilgis (cm)</th>
                        <th scope="col">Plotis (cm)</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($allPrekes as $nt)
                            <tr>


                                <td class="text-center">{{$nt->id}}</td>
                                <td class="text-center">{{$nt->preke->pavadinimas}}</td>
                                <td class="text-center">{{$nt->kiekis}}</td>
                                <td class="text-center">{{$nt->preke->kaina}}</td>
                                <td class="text-center">{{$nt->preke->svoris}}</td>
                                <td class="text-center">{{$nt->preke->aukstis}}</td>
                                <td class="text-center">{{$nt->preke->ilgis}}</td>
                                <td class="text-center">{{$nt->preke->plotis}}</td>
                                <td class="text-center">
                                <div>
                                    <a href="\prekes_sandelyje/edit/{{$nt->id}}" class="btn btn-success fa fa-edit">Keisti</a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div>
                                    <form action="{{ action('PrekesSandelyjeController@delete', ['id' => '1']) }}" method="post">
                                        <button class="btn btn-danger fas fa-trash" type="submit" value="Ištrinti"> Ištrinti</button>
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                </div>
                            </td>
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

{{-- {{ action('PrekesSandelyjeController@edit', $nt->id) }} --}}
