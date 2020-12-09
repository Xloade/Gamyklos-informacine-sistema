@extends('layouts.app')
@section('content')
<div class="container" id="app">
<a href="{{route('admin.create')}}">Create new user</a>
<x-alert/>
    <div class="card shadow border border-secondary">
        <table class="table table-hover table-striped  p-0 m-0">
            <thead>
                <tr class="text-center w-100">
                    <th scope="col">Vardas</th>
                    <th scope="col">E-paštas</th>
                    <th scope="col">Kategorija</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            @foreach($users as $user)
            <tr class="text-center w-100">
                <td scope="col">{{$user->first_name}} {{$user->last_name}}</td>
                <td scope="col">{{$user->email}}</td>
                @php($category = '')
                @switch($user->userlevel)
                    @case(Config::get('constants.KLIENTAS'))
                        @php($category = Config::get('constants.KLIENTO_VARDAS'))
                        @break
                    @case(Config::get('constants.DARBUOTOJAS'))
                        @php($category = Config::get('constants.DARBUOTOJO_VARDAS'))
                        @break
                    @case(Config::get('constants.SANDELIO_VADOVAS'))
                        @php($category = Config::get('constants.SAN_VAD_VARDAS'))
                        @break
                    @case(Config::get('constants.GAMYKLOS_VADOVAS'))
                        @php($category = Config::get('constants.GAM_VAD_VARDAS'))
                        @break
                    @case(Config::get('constants.ADMINISTRATORIUS'))
                        @php($category = Config::get('constants.ADMINISTRATORIAUS_VARDAS'))
                        @break
                    @default
                        @php($category = 'undefined'))
                @endswitch
                <td scope="col">{{ $category}}</td>
                <td scope="col"><a href="{{route('admin.edit',$user->id)}}">Edit</a></td>
                <td scope="col"><button onclick="event.preventDefault();if(confirm('Do you really want to delete this user?')){
                            document.getElementById('form-delete-{{$user->id}}').submit()}">Delete</button>
                </td>
            </tr>
            <form style="display:none" id="{{'form-delete-'.$user->id}}" method="post" action="{{route('admin.destroy', $user->id)}}">
                    @csrf
                    @method('delete')
            </form>
            @endforeach
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