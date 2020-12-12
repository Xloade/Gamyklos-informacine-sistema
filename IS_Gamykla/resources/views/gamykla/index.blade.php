@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Gamyklos</h2>
            <div class="d-flex flex-row-reverse">
                <div>
                    <a class="btn btn-primary fas fas fa-plus" href="{{ action('GamyklaController@create') }}" type="submit">Sukurti gamyklą</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped  p-0 m-0">
                <thead>
                    <tr class="text-center w-100">
                        <th scope="col">Kodas</th>
                        <th scope="col">Pavadinimas</th>
                        <th scope="col">Adresas</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($gamyklos as $gamykla)
                            <tr>
                                <td class="text-center">#{{$gamykla->kodas}}</td>
                                <td class="text-center">{{$gamykla->pavadinimas}}</td>
                                <td class="text-center">{{$gamykla->adresas}}</td>
                                <td class="text-center">
                                    <div>
                                        <a href="{{ action('GamyklaController@edit', $gamykla->kodas) }}" class="btn btn-success fa fa-edit">Keisti</a>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <form action="{{ action('GamyklaController@delete') }}" method="post">
                                            <button class="btn btn-danger fas fa-trash" type="submit"> Ištrinti</button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="id" value="{{$gamykla->kodas}}" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </td>
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