@extends('layouts.app')
@section('content')
<div class="container" id="app">
    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('eparduotuve.completeOrder') }}" >
        @csrf
        <div class="row">
            <h2 class="mx-auto">Banko korteles duomenys</h2>
        </div>

        <div class="form-group">
            <label for="isaugotaKortele">Išsaugota kortele</label>
            <select name="isaugotaKortele" id="isaugotaKortele" class="form-control">
                <option value="" selected>Nauja kortele</option>
                @foreach ($korteles as $kortele)
                    <option value="{{$kortele->korteles_numeris}}">{{$kortele->korteles_numeris}}</option>
                @endforeach
            </select>
        </div>

        <div id="banko-info">
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="sakortele_vardaslis">Vardas</label>
                    <input type="text" class="form-control" id="kortele_vardas" name="kortele_vardas" placeholder="Vardenis" value="{{ old('kortele_vardas') }}" required>
                </div>
                <div class="form-group col-6">
                    <label for="kortele_pavarde">Pavarde</label>
                    <input type="text" class="form-control" id="kortele_pavarde" name="kortele_pavarde" placeholder="Pavardenis" value="{{ old('kortele_pavarde') }}" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="gatve">Korteles numeris</label>
                    <input type="text" class="form-control" id="kortele_nr" name="kortele_nr" placeholder="8654 7865 2364 8752" value="{{ old('kortele_nr') }}" required>
                </div>
                <div class="form-group col-6">
                    <label for="butoNr">CVV</label>
                    <input type="text" class="form-control" id="kortele_cvv" name="kortele_cvv" placeholder="368" value="{{ old('kortele_cvv') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label for="duruKodas">Galiojimo data</label>
                <div class="form-row">
                    <div class="col-md-1 col-2">
                        <input type="text" class="form-control" id="kortele_galiojimoMenuo" name="kortele_galiojimoMenuo" placeholder="08" value="{{ old('kortele_galiojimoMenuo') }}">
                    </div>
                    /
                    <div class="col-md-1 col-2">
                        <input type="text" class="form-control" id="kortele_galiojimoMetai" name="kortele_galiojimoMetai" placeholder="20" value="{{ old('kortele_galiojimoMetai') }}">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label for="kortele_salis">Šalis</label>
                    <input type="text" class="form-control" id="kortele_salis" name="kortele_salis" placeholder="Lietuva" value="{{ old('kortele_salis') }}">
                </div>
                <div class="form-group col-6">
                    <label for="kortele_miestas">Miestas</label>
                    <input type="text" class="form-control" id="kortele_miestas" name="kortele_miestas" placeholder="Kaunas" value="{{ old('kortele_miestas') }}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="kortele_gatve">Gavė</label>
                    <input type="text" class="form-control" id="kortele_gatve" name="kortele_gatve" placeholder="Laisvės g. 6" value="{{ old('kortele_gatve') }}">
                </div>
                <div class="form-group col-6">
                    <label for="kortele_butoNr">Buto nr.</label>
                    <input type="text" class="form-control" id="kortele_butoNr" name="kortele_butoNr" placeholder="256" value="{{ old('kortele_butoNr') }}">
                </div>
            </div>

        </div>

        <!-- --------------------------Pristatimo info-------------------------------------- -->
        <div class="row">
            <h2 class="mx-auto">Pristatimo informacija</h2>
        </div>
        <div class="form-group">
            <div class="col">
                <input class="form-check-input" type="checkbox" id="isaugotasAdresas" name="isaugotasAdresas" {{ old('isaugotasAdresas')?' checked' : '' }}>
                <label class="form-check-label" for="isaugotasAdresas">
                    Naudoti vartotojo adresą
                </label>
            </div>
        </div>
        <div id="pristatimo-info">
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="salis">Šalis *</label>
                    <input type="text" class="form-control" id="salis" name="salis" placeholder="Lietuva" value="{{ old('salis') }}" required>
                </div>
                <div class="form-group col-6">
                    <label for="miestas">Miestas *</label>
                    <input type="text" class="form-control" id="miestas" name="miestas" placeholder="Kaunas" value="{{ old('miestas') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="gatve">Gatvė *</label>
                    <input type="text" class="form-control" id="gatve" name="gatve" placeholder="Laisvės g. 6" value="{{ old('gatve') }}" required>
                </div>
                <div class="form-group col">
                    <label for="butoNr">Buto nr.</label>
                    <input type="text" class="form-control" id="butoNr" name="butoNr" value="{{ old('butoNr') }}" placeholder="256">
                </div>
                <div class="form-group col">
                    <label for="duruKodas">Durų kodas</label>
                    <input type="text" class="form-control" id="duruKodas" name="duruKodas" value="{{ old('duruKodas') }}" placeholder="1256">
                </div>
            </div>
            <div class="col-12">
            <input class="form-check-input" type="checkbox" id="atsimintiAdresa" name="atsimintiAdresa" {{ old('atsimintiAdresa')?' checked' : '' }}>
            <label class="form-check-label" for="atsimintiAdresa">
                Įšsaugoti adresa kaip pagrindinį
            </label>
        </div>
        </div>
        
        <div class="row my-2 mx-auto col-lg-6 col-12">
            <button type="submit" class="btn btn-primary w-100">Patvirtinti</button>
        </div>
    </form>
</div>
<script>
    function disable_bank() {
        if($('#isaugotaKortele').val() == '')
        {
            $('#banko-info :input').prop("disabled", false);
        }else{
            $('#banko-info :input').prop("disabled", true);
        }
    }
    function disable_location() {
        if($('#isaugotasAdresas').is(':checked') == false)
        {
            $('#pristatimo-info :input').prop("disabled", false);
        }else{
            $('#pristatimo-info :input').prop("disabled", true);
        }
    }
    $(document).ready(function() {
        $('#isaugotaKortele').change(function(){
            disable_bank();
        });
        $('#isaugotasAdresas').change(function(){
            disable_location();
        });
        let element = document.getElementById('isaugotaKortele');
        element.value = '{{ old('isaugotaKortele') }}';
        disable_bank();
        disable_location();
    });
</script>
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