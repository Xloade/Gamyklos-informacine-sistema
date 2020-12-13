@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Tvarkaraštis</h2>
            <div class="d-flex flex-row-reverse">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th scope="col" style="width: 10%">Data</th>
                    <th scope="col">{{$tvarkarastis->data}}</th>
                </tr>
                @for ($i = 8; $i < 24; $i++)
                    <tr>
                        <td scope="col" class="bg-light">{{$i}}:00</td>
                        @if ($i == 12)
                            <td scope="col" class="bg-success">Pietų pertrauka</td>
                        @else
                            @if ($i >= $tvarkarastis->darbas_nuo && $i <= $tvarkarastis->darbas_iki)
                                <td scope="col" class="bg-primary">Dirba: {{$tvarkarastis->worker->first_name}} {{$tvarkarastis->worker->last_name}}</td>
                            @else
                                <td scope="col" class="bg-secondary"></td>
                            @endif
                        @endif
                    </tr>
                @endfor
            </table>
        </div>  
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