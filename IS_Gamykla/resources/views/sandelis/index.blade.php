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
                    <p></p>
                    <form action="{{ action('SandelisController@uzsakyti') }}" method="get">
                        <button type="submit" name="calculate" id="calculate" class="btn btn-info">
                            <i class="fas fa-plus"> Užsakyti prekę</i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-row-reverse">
                <div>
                    <a class="btn btn-info fas fas fa-plus" href="{{ action('SandelisController@create') }}" type="submit">Sukurti sandėlį</a>
                    <a class="btn btn-info fas fas fa-plus" href="{{ action('SandelisController@add') }}" type="submit">Pridėti prekę</a>

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
                        <th scope="col">Talpa</th>
                        <th scope="col">Prekės sandelyje</th>
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
                                <td class="text-center">{{ $sandelis->talpa }} m&#x00B3</td>
                                <td class="text-center">
                                    <div>

                                        <a href="{{ action('PrekesSandelyjeController@index', $sandelis->sandelio_kodas) }}" class="btn btn-info fa fa-eye">Peržiūrėti prekes</a>

                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <a href="{{ action('SandelisController@edit', $sandelis->sandelio_kodas) }}" class="btn btn-success fa fa-edit">Keisti</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <form action="{{ action('SandelisController@delete') }}" method="post">
                                            <button class="btn btn-danger fas fa-trash" type="submit"> Ištrinti</button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="id" value="{{ $sandelis->sandelio_kodas }}" />
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
