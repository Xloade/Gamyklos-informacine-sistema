@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <table class="table table-hover table-striped  p-0 m-0">
            <thead>
                <tr class="text-center w-100">
                    <th scope="col">ID</th>
                    <th scope="col">Pavadinimas</th>
                    <th scope="col">Adresas</th>
                </tr>
            </thead>
        </table>
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