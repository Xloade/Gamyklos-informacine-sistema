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
                @for ($e = 0; $e < 7; $e++)
                    <tr>
                        <th scope="col" style="width: 10%">Data</th>
                        <th scope="col">{{ Carbon\Carbon::now()->addDays($e)->format('Y-m-d') }}</th>
                    </tr>
                    @for ($i = 8; $i < 18; $i++)
                    <tr>
                        <td scope="col" class="bg-light">{{$i}}:00</td>
                        @if ($i == 12)
                            <td scope="col" class="{{$e % 2 == 0 ? 'bg-success' : '' }}"> {{$e % 2 == 0 ? 'Pietų pertrauka' : '' }}</td>
                        @else
                            <td scope="col" class="{{$e % 2 == 0 ? 'bg-primary' : '' }}"> {{$e % 2 == 0 ? 'Darbas' : '' }}</td>
                        @endif
                    </tr>
                    @endfor
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