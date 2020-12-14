@extends('layouts.app')
@section('content')
<div class="container" id="app">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>
        {{$preke->pavadinimas}}
    </h2>
    <table class="table">
        <tr>
            <th>Kodas</th>
            <td>{{$preke->prekes_kodas}}</td>
        </tr>
        <tr>
            <th>Dimensijos (plotis x ilgis x aukštis)</th>
            <td>{{$preke->plotis}}cm x {{$preke->ilgis}}cm x {{$preke->aukstis}}cm</td>
        </tr>
        <tr>
            <th>Svoris</th>
            <td>{{$preke->svoris}} kg</td>
            </tr>
        <tr>
            <th>Kaina</th>
            <td>{{$preke->kaina}} €</td>
        </tr>
        </table>

    <h3>
        Prideti į krepšelį
    </h3>
    <form class="form" action="{{route('eparduotuve.addToCart')}}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col">
                <label for="sandelys">Sandelys</label>
                <select type="text" class="form-control" id="sandelys" name="id">
                        <option hidden="true" value="" selected></option>
                    @foreach ($sandeliai as $sandelys)
                        <option value="{{$sandelys->id}}">{{$sandelys->salis}}, {{$sandelys->miestas}}, {{$sandelys->gatve}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <label for="kiekis">Prekiu skaičius</label>
                <input type="text" class="form-control" id="kiekis" name="kiekis" placeholder="10">
            </div>
        </div>
        
        <div class="row my-2 mx-auto col-lg-6 col-12">
            <button type="submit" class="btn btn-primary w-100">Pridėti</button>
        </div>
    </form>
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