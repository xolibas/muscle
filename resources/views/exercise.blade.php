@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$exercise->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$exercise->name}}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{$exercise->text}}</td>
        </tr>
        <tr>
            <th>Image</th><td><img style="width:200px;height=200px;" src="{{$exercise->image}}"></td>
        </tr>
        <tr>
            <th>Muscle</th><td>{{$exercise->muscle}}</td>
        </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection
