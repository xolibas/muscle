@extends('layouts.app')
@section('content')
    @include('admin.exercises._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.exercises.edit',$exercise)}}" class="btn btn-primary mr-1">Edit</a>
      <?php /*  <a href="{{route('admin.exercises.image',$exercise)}}" class="btn btn-block mr-1">Image</a> */ ?>
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
            <th>Image</th><td><img style="width:200px;height=200px;" src="{{$exercise->image}}"></td>
        </tr>
        <tr>
            <th>Muscle</th><td>{{$exercise->muscle}}</td>
        </tr>
        </tbody>
    </table>
    <?php /*<h3>Image upload</h3>
    <form action="{{route('admin.exercises.imageLoad',$exercise)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>*/ ?>
@endsection
