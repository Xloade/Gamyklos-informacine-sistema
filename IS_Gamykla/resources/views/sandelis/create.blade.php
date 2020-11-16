@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('sandelis.store') }}" method="POST">
            <div class="card-header text-center">
                <h2>Sandėlio forma</h2>
            </div>
            <div class="card-body">
                <div class="form-row my-2">
                    <label for="sandelis_country" class="col-form-label col-md-3 text-right">Šalis</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_country" id="sandelis_country" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_city" class="col-form-label col-md-3 text-right">Miestas</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_city" id="sandelis_city" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_adress" class="col-form-label col-md-3 text-right">Gatvė</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_adress" id="sandelis_adress" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_size" class="col-form-label col-md-3 text-right">Talpa</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_size" id="sandelis_size" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_boss" class="col-form-label col-md-3 text-right">Sandėlio vadovas</label>
                    <div class="col-md-3">
                        <select name="sandelis_boss" id="sandelis_boss" class="form-control">
                            <option value="0" selected>Petras Petraitis</option>
                            <option value="1">Petras Petraitytis</option>
                          </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="float-right btn btn-primary my-2" type="submit">
                  <i class="fa fa-save mr-1" aria-hidden="true"></i>
                  Saugoti
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