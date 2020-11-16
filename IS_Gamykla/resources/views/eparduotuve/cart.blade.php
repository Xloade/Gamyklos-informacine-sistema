@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <table class="table">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Pavadinimas</th>
                <th>Sandelys</th>
                <th>Kiekis</th>
                <th>Kaina</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">1</td>
                <td><a href="#">Škyvas 125x50x100</a></td>
                <td>Vilniaus</td>
                <td>15</td>
                <td>1542.25 €</td>
                <td><button type="button" class="btn btn-warning">X</button></td>
            </tr>
            <tr>
                <td scope="row">2</td>
                <td><a href="#">Guoliaviete</a></td>
                <td>Kauno</td>
                <td>125</td>
                <td>5264.01 €</td>
                <td><button type="button" class="btn btn-warning">X</button></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Iš viso:</td>
                <td colspan="2">6806.26 €</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="mx-auto w-50">
            <a href="{{ route('eparduotuve.complete') }}" type="button" class="btn btn-primary w-100">Pradeti užsakymą</a>
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