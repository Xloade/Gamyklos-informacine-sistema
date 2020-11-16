@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('tvarkarasciai.update', ['id' => '1']) }}" method="POST">
            <div class="card-header">
                <h2 class="text-center">Tvarkaraščio forma</h2>
                <div class="row">
                    <div class="col-sm-5">          
                        <label for="factory" class="col-form-label font-weight-bold">Gamykla</label>
                        <select name="factory" id="factory" class="form-control">
                            <option value="0" selected>Gamykla #1</option>
                            <option value="1">Gamykla #2</option>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <label for="date" class="col-form-label font-weight-bold">Data</label>
                        <input class="form-control" type="date" id="date" name="date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" max="2022-12-31">
                    </div>
                </div>
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
                            <select name="worker[0][name]" id="worker" class="form-control">
                                <option value="0" selected>Jonas Jonaitis</option>
                                <option value="1">Jonas Jonaitytis</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="worker[0][hoursFrom]" placeholder="Darbo valandos nuo" class="form-control" />
                        </div>
                        <div class="col">
                            <input type="number" name="worker[0][hoursTo]" placeholder="Darbo valandos iki" class="form-control" />
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <button type="button" name="add" id="add" class="btn btn-success add-row">
                    <i class="fas fa-user-plus"> Pridėti</i>
                </button>
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
    var i = 0;
    $(document).on('click', '.add-row',function(){
        ++i;
        $("#dynamicTable").append('<div class="row my-2"><div class="col"><select name="worker['+i+'][name]" id="worker" class="form-control"><option value="0" selected>Jonas Jonaitis</option><option value="1">Jonas Jonaitytis</option></select></div><div class="col"><input type="number" name="worker['+i+'][hours]" placeholder="Darbo valandos" class="form-control" /></div><div class="col"><input type="number" name="worker[0][hoursTo]" placeholder="Darbo valandos iki" class="form-control" /></div><div class="col"><button type="button" name="remove" id="remove" class="btn btn-danger remove-row"><i class="fas fa-user-times" aria-hidden="true"></i></button></div></div>');
    });

    $(document).on('click', '.remove-row', function(){  
         $(this).parents('.row').remove();
    });  
</script>
@endsection