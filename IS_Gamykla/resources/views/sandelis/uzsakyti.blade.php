@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('sandelis.uzsakymasideti') }}" method="POST">
            <div class="card-header text-center">
                <h2>Prekės užsakymas</h2>
            </div>
            <div class="card-body">

                <div class="form-row my-2">
                    <label for="fk_prekeId" class="col-form-label col-md-3 text-right">Prekė</label>
                    <div class="col-md-3">
                        <select name="fk_prekeId" id="fk_prekeId" class="form-control">
                            @foreach ($preke as $nt)

                            <option value="{{$nt->prekes_kodas}}" >{{$nt->pavadinimas}}</option>

                            @endforeach
                          </select>
                    </div>
                </div>

                <div class="form-row my-2">
                    <label for="preke_count" class="col-form-label col-md-3 text-right">Kiekis</label>
                    <div class="col-md-3">
                        <input type="textbox" name="preke_count" id="preke_count" class="form-control">
                    </div>
                </div>

                <div class="form-row my-2">
                    <label for="fk_sandelisId" class="col-form-label col-md-3 text-right">Sandėlis</label>
                    <div class="col-md-3">
                        <select name="fk_sandelisId" id="fk_sandelisId" class="form-control">
                            @foreach ($sandeliai as $nt)

                            <option value="{{$nt->fk_sandelisId}}" >{{$nt->sandelis->salis}}, {{$nt->sandelis->miestas}}, {{$nt->sandelis->gatve}}</option>

                            @endforeach
                          </select>
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
