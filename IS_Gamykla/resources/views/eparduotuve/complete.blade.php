@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <form action="post">
        <div class="row">
            <h2 class="mx-auto">Banko korteles duomenys</h2>
        </div>

        <div class="form-group">
            <label for="isaugotaKortele">Išsaugota kortele</label>
            <select name="isaugotaKortele" id="isaugotaKortele" class="form-control">
                <option value="0" selected>Nauja kortele</option>
                <option value="1" selected>8567423698547856</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="salis">Vardas</label>
                <input type="text" class="form-control" id="salis" name="salis" placeholder="Vardenis" required>
            </div>
            <div class="form-group col-6">
                <label for="miestas">Pavarde</label>
                <input type="text" class="form-control" id="miestas" name="miestas" placeholder="Pavardenis" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-6">
                <label for="gatve">Korteles numeris</label>
                <input type="text" class="form-control" id="gatve" name="gatve" placeholder="8654 7865 2364 8752" required>
            </div>
            <div class="form-group col-6">
                <label for="butoNr">CVV</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="368">
            </div>
        </div>
        
        <div class="form-group">
            <label for="duruKodas">Galiojimo data</label>
            <div class="form-row">
                <div class="col-md-1 col-2">
                    <input type="text" class="form-control" id="galiojimoMenuo" name="duruKodas" placeholder="08">
                </div>
                /
                <div class="col-md-1 col-2">
                    <input type="text" class="form-control" id="galiojimoMetai" name="duruKodas" placeholder="20">
                </div>
            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="butoNr">Šalis</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="Lietuva">
            </div>
            <div class="form-group col-6">
                <label for="butoNr">Miestas</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="Kaunas">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-6">
                <label for="butoNr">Gavė</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="Laisvės g. 6">
            </div>
            <div class="form-group col-6">
                <label for="butoNr">Buto nr.</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="256">
            </div>
        </div>

        <div class="col-12">
            <input class="form-check-input" type="checkbox" value="" id="atsimintiKortele" name="atsimintiKortele">
            <label class="form-check-label" for="atsimintiKortele">
                Įsiminti banko kortelę
            </label>
        </div>

        <!-- --------------------------Pristatimo info-------------------------------------- -->
        <div class="row">
            <h2 class="mx-auto">Pristatimo informacija</h2>
        </div>
        <div class="form-group">
            <label for="isaugotasAdresas">Išsaugotas adresas</label>
            <select name="isaugotasAdresas" id="isaugotasAdresas" class="form-control">
                <option value="0" selected>Naujas adresas</option>
                <option value="1" selected>Laisvės g. 5, Rokiškis, Lietuva</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-6">
                <label for="salis">Šalis *</label>
                <input type="text" class="form-control" id="salis" name="salis" placeholder="Lietuva" required>
            </div>
            <div class="form-group col-6">
                <label for="miestas">Miestas *</label>
                <input type="text" class="form-control" id="miestas" name="miestas" placeholder="Kaunas" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col">
                <label for="gatve">Gatvė *</label>
                <input type="text" class="form-control" id="gatve" name="gatve" placeholder="Laisvės g. 6" required>
            </div>
            <div class="form-group col">
                <label for="butoNr">Buto nr.</label>
                <input type="text" class="form-control" id="butoNr" name="butoNr" placeholder="256">
            </div>
            <div class="form-group col">
                <label for="duruKodas">Durų kodas</label>
                <input type="text" class="form-control" id="duruKodas" name="duruKodas" placeholder="1256">
            </div>
        </div>
        <div class="col-12">
            <input class="form-check-input" type="checkbox" value="" id="atsimintiAdresa" name="atsimintiAdresa">
            <label class="form-check-label" for="atsimintiAdresa">
                Įsiminti adresą
            </label>
        </div>
        <div class="col-12">
            <div >* - privalomas laukas</div>
        </div>
        <div class="row my-2 mx-auto col-lg-6 col-12">
            <button type="button" class="btn btn-primary w-100">Patvirtinti</button>
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