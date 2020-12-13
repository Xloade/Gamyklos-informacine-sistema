@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('tvarkarasciai.store') }}" method="POST">
            <div class="card-header">
                <h2 class="text-center">Tvarkaraščio forma</h2>
                <div class="row">
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
                            <span class="font-weight-bold">Valandos</span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row my-2">
                        <div class="col">
                            <select name="worker[0][name]" id="worker" class="form-control" required>
                                @foreach ($gamykla->worker as $worker)
                                    {{$gamykla->kodas}}
                                    <option value="{{$worker->id}}">{{$worker->first_name}} {{$worker->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="worker[0][hoursFrom]" placeholder="Darbo valandos nuo" class="form-control" min="8" max="22" required/>
                        </div>
                        <div class="col">
                            <input type="number" name="worker[0][hoursTo]" placeholder="Darbo valandos iki" class="form-control" min="9" max="23" required/>
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
                @php
                    if($gamykla->boss != null){
                        $bossid = $gamykla->boss->id;
                    }
                    else{
                        $bossid = null;
                    }  
                @endphp
                <input type="hidden" name="boss" value="{{$bossid}}" />
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
    var workers  = {!! json_encode($gamykla->worker) !!};
    $(document).on('click', '.add-row',function(){
        if(i < workers.length-1){
            ++i;
            var html = '<div class="row my-2"><div class="col">';
            html += '<select name="worker['+i+'][name]" id="worker" class="form-control required">';
            var e;
            for(e = 0; e < workers.length; e++){
                html += '<option value="'+workers[e].id+'" selected>'+workers[e].first_name+' '+workers[e].last_name+'</option>'
            }
            html += '</select></div>';
            html += '<div class="col">';
            html += '<input type="number" name="worker['+i+'][hoursFrom]" placeholder="Darbo valandos" class="form-control" min="8" max="22" required/></div>';
            html += '<div class="col">';
            html += '<input type="number" name="worker['+i+'][hoursTo]" placeholder="Darbo valandos iki" class="form-control" min="9" max="23" required/></div>';
            html += '<div class="col"><button type="button" name="remove" id="remove" class="btn btn-danger remove-row"><i class="fas fa-user-times" aria-hidden="true"></i></button></div></div>';
            $("#dynamicTable").append(html);
        }
    });

    $(document).on('click', '.remove-row', function(){ 
        --i; 
         $(this).parents('.row').remove();
    });  
</script>
@endsection