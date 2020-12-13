@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('sandelis.ideti') }}" method="POST">
            <div class="card-header text-center">
                <h2>Prekės pridėjimas</h2>
            </div>
            <div class="card-body">
                <div class="form-row my-2">
                    <label for="preke_name" class="col-form-label col-md-3 text-right">Pavadinimas</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_name" id="preke_name" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="preke_cost" class="col-form-label col-md-3 text-right">Kaina</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_cost" id="preke_cost" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="preke_weight" class="col-form-label col-md-3 text-right">Svoris (kg)</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_weight" id="preke_weight" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="preke_height" class="col-form-label col-md-3 text-right">Aukštis (cm)</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_height" id="preke_height" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="preke_length" class="col-form-label col-md-3 text-right">Ilgis (cm)</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_length" id="preke_length" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="preke_width" class="col-form-label col-md-3 text-right">Plotis (cm)</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_width" id="preke_width" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="float-right btn btn-primary my-2" type="submit">
                  <i class="fa fa-save mr-1" aria-hidden="true"></i>
                  Užsakyti
                </button>
                <input type="hidden" name="_method" value="post" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a class="float-right mr-2 btn btn-danger my-2" href="{{ route('sandelis.index') }}">
                  <i class="fa fa-times mr-1" aria-hidden="true"></i>
                  Atšaukti
                </a>
            </div>
        </form>
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
