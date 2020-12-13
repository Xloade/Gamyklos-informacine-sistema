@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('tvarkarasciai.update', $tvarkarastis->id) }}" method="post">
            <input type="hidden" name="id" value="{{$tvarkarastis->id}}" />
            <div class="card-header">
                <h2 class="text-center">Tvarkaraščio forma</h2>
            </div>
            <div class="card-body">
                <div class="table" id="dynamicTable">
                    <div class="row my-2">
                        <div class="col">
                            <span class="font-weight-bold">Darbuotojas</span>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Valandos nuo</span>
                        </div>
                        <div class="col">
                            <span class="font-weight-bold">Valandos iki</span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row my-2">
                        <div class="col">
                            <span>{{$tvarkarastis->worker->first_name}} {{$tvarkarastis->worker->last_name}}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="hoursFrom" placeholder="Darbo valandos nuo" class="form-control" min="8" max="22" value="{{$tvarkarastis->darbas_nuo}}" required/>
                        </div>
                        <div class="col">
                            <input type="number" name="hoursTo" placeholder="Darbo valandos iki" class="form-control" min="9" max="23" value="{{$tvarkarastis->darbas_iki}}" required/>
                        </div>
                        <div class="col"></div>
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
                <a class="float-right mr-2 btn btn-danger my-2" href="{{ route('tvarkarasciai.index') }}">
                  <i class="fa fa-times mr-1" aria-hidden="true"></i>
                  Atšaukti
                </a>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
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