@extends('layouts.app')
@section('content')
<div class="container" id="app">
    <h2>Krepšelis</h2>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Pavadinimas</th>
                <th>Sandelys</th>
                <th>Kiekis</th>
                <th>Kaina</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        
        @foreach ($prekes as $key => $preke)
            <tr>
                <td scope="row">{{$key + 1}}</td>
                <td><a href="{{route('eparduotuve.show', ['id' => $preke->prekeId])}}">{{$preke->pavadinimas}}</a></td>
                <td>{{$preke->salis}}, {{$preke->miestas}}, {{$preke->gatve}}</td>
                <td>{{$preke->kiekis}}</td>
                <td>{{$preke->kaina}} €</td>
                <td>
                <button class="btn btn-danger fas fa-trash" onclick="event.preventDefault();if(confirm('Ar tikrai norite pašalinti preke iš krepšelio?')){
                                    document.getElementById('form-delete-{{$preke->id}}').submit()}">Ištrinti</button>
                    <form style="display:none" id="{{'form-delete-'.$preke->id}}" method="post" action="{{route('eparduotuve.removeFromCart', ['id' => $preke->id])}}">
                            @csrf
                            @method('delete')
                    </form> 
                </td>

                <!-- <td><a type="button" class="btn btn-warning" href="{{route('eparduotuve.removeFromCart', ['id' => 1])}}">X</a></td> -->
            </tr>
        @endforeach
            <tr>
                <td colspan="4" class="text-right">Iš viso:</td>
                <td colspan="2">{{$isViso[0]->isViso}} €</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="mx-auto w-50">
            <a href="{{ route('eparduotuve.order') }}" type="button" class="btn btn-primary w-100">Pradeti užsakymą</a>
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