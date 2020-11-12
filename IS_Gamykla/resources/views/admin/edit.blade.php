@extends('layouts.app')

@section('content')
    <h1>User info</h1>
    <h2>{{$user->first_name}} {{$user->last_name}}</h2>
    <h2>{{$user->email}}</h2>
    <x-alert/>
        <form method="post" action="{{route('admin.update',$user->id)}}">
            @csrf
            @method('patch')
            <input type="text" value="{{$user->userlevel}}" name="userlevel">Kategorija</input>
            <input type="hidden" value="{{$user->first_name}}" name="first_name"/>
            <input type="hidden" value="{{$user->last_name}}" name="last_name"/>
            <input type="hidden" value="workaroundEmail@address.com" name="email"/>
            <input type="submit" value="Update"/>  
        </form>
        <form style="display:none" id="{{'form-delete-'.$user->id}}" method="post" action="{{route('admin.destroy', $user->id)}}">
                    @csrf
                    @method('delete')
            </form>
        <a href="{{route('admin.index')}}">Back</a>
        <button onclick="event.preventDefault();if(confirm('Do you really want to delete this user?')){
            document.getElementById('form-delete-{{$user->id}}').submit()}">Delete</button>
@endsection