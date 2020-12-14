@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <form action="{{ route('sandelis.search') }}" method="get" class="form">
        <h2>Paieška</h2>
        @if (count($errors) > 0)
            <div class = "alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <input type="hidden" id="fk_prekeId" name="fk_prekeId" value="{{}}"> --}}

        <h4>Pagal pavadinimą</h4>
        <div class="form-row input-group">
        <div class="col">
            <input name="pavadinimas"  type="text" class="form-control col" value="{{ old('pavadinimas') }}" placeholder="pavadinimas">
        </div>
        </div>
        <p></p>
        <h4>Pagal kainą</h4>
        <div class="form-row">
            <div class="input-group col">
                <input name="kaina-max"  type="number" class="form-control col" step="0.01" value="{{ old('kaina-max') }}" placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="kaina-min" type="number" class="form-control col" step="0.01" value="{{ old('kaina-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">€</span>
                </div>
            </div>
        </div>
        <p></p>
        <h4>Pagal svorį</h4>
        <div class="form-row">
            <div class="input-group col">
                <input name="svoris-max" type="number" class="form-control col" step="0.01" value="{{ old('svoris-max') }}"  placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="svoris-min" type="number" class="form-control col" step="0.01" value="{{ old('svoris-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">kg</span>
                </div>
            </div>
        </div>
        <p></p>
        <h4>Pagal tūrį</h4>
        <div class="form-row">
            <div class="input-group col">
                <input name="turis-max" type="number" class="form-control col" step="0.01" value="{{ old('turis-max') }}"  placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">l</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="turis-min" type="number" class="form-control col" step="0.01" value="{{ old('turis-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">l</span>
                </div>
            </div>
        </div>
        <p></p>
        <h4>Pagal dimensijas</h4>
        <label>Plotis</label>
        <div class="form-row">
            <div class="input-group col">
                <input name="plotis-max" type="number" class="form-control col" step="0.01" value="{{ old('plotis-max') }}"  placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="plotis-min" type="number" class="form-control col" step="0.01" value="{{ old('plotis-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
        </div>
        <label>Ilgis</label>
        <div class="form-row">
            <div class="input-group col">
                <input name="ilgis-max" type="number" class="form-control col" step="0.01" value="{{ old('ilgis-max') }}"  placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="ilgis-min" type="number" class="form-control col" step="0.01" value="{{ old('ilgis-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
        </div>
        <label>Aukštis</label>
        <div class="form-row">
            <div class="input-group col">
                <input name="aukstis-max" type="number" class="form-control col" step="0.01" value="{{ old('aukstis-max') }}"  placeholder="max">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
            -
            <div class="input-group col">
                <input name="aukstis-min" type="number" class="form-control col" step="0.01" value="{{ old('aukstis-min') }}"  placeholder="min">
                <div class="input-group-append">
                    <span class="input-group-text">cm</span>
                </div>
            </div>
        </div>
        <p></p>
        <h4>Likutis sandeliuose</h4>
        <div class="form-row">
            <div class="form-group col">
                <label for="sandelys">Sandėlis</label>
                <select name="sandelys" type="number" class="form-control" id="sandelys" name="sandelys">
                    <option hidden='true' value="">Pasirinkite sandelį</option>
                    <option  value="">Nefiltruoti</option>
                    <option value="0">Bet kuriame</option>
                    @foreach ($sandeliai as $sandelys)
                        <option value="{{$sandelys->id}}">{{$sandelys->salis}}, {{$sandelys->miestas}}, {{$sandelys->gatve}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <p></p>
        <div class="row my-2 mx-auto col-lg-6 col-12">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i>Ieškoti</button>
        </div>
    </form>
    <h2>Rezultatai</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Pavadinimas</th>
                <th>Kaina</th>
                <th>Išmatavimai(plotis x ilgis x aukstis)</th>
                <th>Svoris</th>
                <th>Kiekis sandėliuose</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @if (isset($prekes))
        @foreach ($prekes as $key => $preke)
            <tr>
                <td scope="row">{{$key + 1}}</td>
                <td>{{$preke->pavadinimas}}</td>
                <td>{{$preke->kaina}} €</td>
                <td>{{$preke->plotis}}cm x {{$preke->ilgis}}cm x {{$preke->aukstis}}cm</td>
                <td>{{$preke->svoris}} kg</td>
                <td>{{$preke->kiekis}}</td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
</div>
<script>
    let element = document.getElementById('sandelys');
    element.value = {{ old('sandelys') }};
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
