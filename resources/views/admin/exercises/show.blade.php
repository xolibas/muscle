@extends('layouts.app')
@section('content')
    @include('admin.exercises._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.exercises.edit',$exercise)}}" class="btn btn-primary mr-1">Edit</a>
        <form method="POST" action="{{route('admin.exercises.update',$exercise)}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

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
            <th>Image</th><td><img src="{{$exercise->image}}"></td>
        </tr>
        </tbody>
    </table>
@endsection
