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
                        <tr>
                            <td class="text-center">#1</td>
                            <td class="text-center">Lietuva</td>
                            <td class="text-center">Kaunas</td>
                            <td class="text-center">Elektėnų g. 8</td>
                            <td class="text-center">0%</td>
                        </tr>
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