@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <div class="card shadow border border-secondary">
        <div class="card-header">
            <h2 class="text-center">Sandėliai</h2>
            <div class="col">
                <div class="row">
                <div class="col">
                    <form action="{{ action('SandelioUzimtumasController@show') }}" method="get">
                        <button type="submit" name="calculate" id="calculate" class="btn btn-info">
                            <i class="fas fa-chart-bar"> Tikrinti sandėlių užimtumą</i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <div>
                    <form action="{{ action('SandelisController@create') }}" method="get">
                        <button class="btn btn-default fas fas fa-plus" type="submit" value="Sukurti"> Sukurti sandėlį</button>
                        <input type="hidden" name="_method" value="create" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
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
                        <th scope="col">Talpa (kūbiniais metrais)</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($sandeliai as $sandelis)
                            <tr>
                                <td class="text-center">#{{ $sandelis->sandelio_kodas }}</td>
                                <td class="text-center">{{ $sandelis->salis }}</td>
                                <td class="text-center">{{ $sandelis->miestas }}</td>
                                <td class="text-center">{{ $sandelis->gatve }}</td>
                                <td class="text-center">{{ $sandelis->talpa }}</td>
                                <td class="text-center">
                                    <div>
                                        <form action="{{ action('PrekesSandelyjeController@index', $sandelis->sandelio_kodas) }}" method="get">
                                            <button class="btn btn-default fas fa-eye" type="submit" value="Keisti"> Peržiūrėti prekes</button>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <form action="{{ action('SandelisController@edit', $sandelis->sandelio_kodas) }}" method="get">
                                            <button class="btn btn-default fas fa-edit" type="submit" value="Keisti"> Keisti</button>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <form action="{{ action('SandelisController@delete', ['id' => $sandelis->sandelio_kodas]) }}" method="post">
                                            <button class="btn btn-default fas fa-trash" type="submit" value="Ištrinti"> Ištrinti</button>
                                            <input type="hidden" name="_method" value="delete" />
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
