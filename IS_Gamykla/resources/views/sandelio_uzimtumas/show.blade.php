@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Sandėlio užimtumas</h2>
            <div class="d-flex flex-row-reverse">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Kodas</th>
                        <th scope="col">Šalis</th>
                        <th scope="col">Miestas</th>
                        <th scope="col">Gatvė</th>
                        <th scope="col">Užpildymas</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($sandeliai as $sandelis)
                            <tr>
                                <td class="text-center">#{{ $sandelis->sandelio_kodas }}</td>
                                <td class="text-center">{{ $sandelis->salis }}</td>
                                <td class="text-center">{{ $sandelis->miestas }}</td>
                                <td class="text-center">{{ $sandelis->gatve }}</td>
                                <td class="text-center">{{ $sandelis->uzpildyta }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
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