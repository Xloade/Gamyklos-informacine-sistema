@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <h2>
        Škyvas 125x50x100
    </h2>
    <table class="table">
        <tr>
            <th>Kodas</th>
            <td>AJFUR4584945</td>
        </tr>
        <tr>
            <th>Dimensijos (plotis x ilgis x aukštis)</th>
            <td>125mm x 50mm x 100mm</td>
        </tr>
        <tr>
            <th>Svoris</th>
            <td>2 kg</td>
            </tr>
        <tr>
            <th>Kaina</th>
            <td>5264.01 €</td>
        </tr>
        </table>

    <h3>
        Prideti į krepšelį
    </h3>
    <form class="form">
        <div class="form-row">
            <div class="form-group col">
                <label for="sandelys">Sandelys</label>
                <select type="text" class="form-control" id="sandelys" name="sandelys">
                    <option value="" selected></option>
                    <option value="0">Kauno</option>
                    <option value="1">Vilniaus</option>
                </select>
            </div>
            <div class="form-group col">
                <label for="prekiuSk">Prekiu skaičius</label>
                <input type="text" class="form-control" id="prekiuSk" name="prekiuSk" placeholder="10">
            </div>
        </div>
        
        <div class="row my-2 mx-auto col-lg-6 col-12">
            <button type="button" class="btn btn-primary w-100">Pridėti</button>
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