@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <form action="{{ route('gamyklos.update', ['id' => $gamykla->kodas]) }}" method="POST">
            <div class="card-header text-center">
                <h2>Gamyklos forma</h2>
            </div>
            <div class="card-body">
                <input type="hidden" name="id" value="{{$gamykla->kodas}}" />
                <div class="form-row my-2">
                    <label for="gamykla_name" class="col-form-label col-md-3 text-right">Pavadinimas</label>
                    <div class="col-md-3">
                        <input type="textbox" name="gamykla_name" id="gamykla_name" class="form-control" value="{{$gamykla->pavadinimas}}" required>
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="gamykla_adress" class="col-form-label col-md-3 text-right">Adresas</label>
                    <div class="col-md-3">
                        <input type="textbox" name="gamykla_adress" id="gamykla_adress" class="form-control" value="{{$gamykla->adresas}}" required>
                    </div>
                </div>
                <div class="form-row my-2">
                    <label for="gamykla_boss" class="col-form-label col-md-3 text-right">Vadovas</label>
                    <div class="col-md-3">
                        <select name="gamykla_boss" id="gamykla_boss" class="form-control">
                            @foreach ($gamykla->worker as $worker)
                            @if ($worker->userlevel != Config::get('constants.ADMINISTRATORIUS'))
                                @if ($boss != $worker)
                                    <option value="{{$worker->id}}">{{$worker->first_name}} {{$worker->last_name}}</option>
                                @endif
                                @if ($boss == $worker)
                                    <option value="{{$worker->id}}" selected>{{$worker->first_name}} {{$worker->last_name}}</option>
                                @endif   
                            @endif
                            @endforeach
                            <option value="-1" @if ($boss == null)
                            selected    
                            @endif>Niekas</option>
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
                <a class="float-right mr-2 btn btn-danger my-2" href="{{ route('gamyklos.index') }}">
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