@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <form action="" method="get" class="form">
        <h2>Paieška</h2>
        <h4>Kaina</h4>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <h4>Svoris</h4>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                </div>
            </div>
        </div>
        <h4>Turis</h4>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">l</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">l</span>
                </div>
            </div>
        </div>
        <h4>Dimensijos</h4>
        <label>Plotis</label>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>
        <label>Ilgis</label>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>
        <label>Aukštis</label>
        <div class="form-row">
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input type="text" class="form-control col" placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">mm</span>
                </div>
            </div>
        </div>
        
        <h4>Likutis sandeliuose</h4>
        <div class="form-row">
            <div class="form-group col">
                <label for="sandelys">Sandelys</label>
                <select type="text" class="form-control" id="sandelys" name="sandelys">
                    <option value="">Visi</option>
                    <option value="0">Kauno</option>
                    <option value="1">Vilniaus</option>
                </select>
            </div>
            <div class="form-group col">
                <label for="butoNr">Likutis</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="min">
            </div>
        </div>
        <div class="row my-2 mx-auto col-lg-6 col-12">
                <button type="button" class="btn btn-primary w-100"><i class="fas fa-search"></i>Ieškoti</button>
        </div>
    </form>
    <h2>Rezultatai</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pavadinimas</th>
                <th>Kaina</th>
                <th>Išmatavimai</th>
                <th>Svoris</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="#">Škyvas 125x50x100</a></td>
                <td>1542.25 €</td>
                <td>125mm x 50mm x 100mm</td>
                <td>3kg</td>
                <td><a href="{{ route('eparduotuve.show', '1') }}" type="button" class="btn btn-info">Daugiau</a></td>
            </tr>
            <tr>
                <td><a href="#">Guoliaviete</a></td>
                <td>5264.01 €</td>
                <td>10mm x 20mm x 50mm</td>
                <td>0,2 kg</td>
                <td><a href="{{ route('eparduotuve.show', '1') }}" type="button" class="btn btn-info">Daugiau</a></td>
            </tr>

        </tbody>
    </table>
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