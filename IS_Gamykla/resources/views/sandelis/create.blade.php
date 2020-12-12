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
                    <label for="sandelis_salis" class="col-form-label col-md-3 text-right">Šalis</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_salis" id="sandelis_salis" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_miestas" class="col-form-label col-md-3 text-right">Miestas</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_miestas" id="sandelis_miestas" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_gatve" class="col-form-label col-md-3 text-right">Gatvė</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_gatve" id="sandelis_gatve" class="form-control">
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="sandelis_talpa" class="col-form-label col-md-3 text-right">Talpa</label>
                    <div class="col-md-3">
                        <input type="textbox" name="sandelis_talpa" id="sandelis_talpa" class="form-control">
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