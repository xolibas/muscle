@extends('layouts.app')
@section('content')
    @include('admin.programs._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.programs.edit',$program)}}" class="btn btn-primary mr-1">Edit</a>
      <?php /*  <a href="{{route('admin.programs.image',$program)}}" class="btn btn-block mr-1">Image</a> */ ?>
        <form method="POST" action="{{route('admin.programs.update',$program)}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$program->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$program->name}}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{$program->text}}</td>
        </tr>
        <tr>
            <th>Image</th><td><img style="width:200px;height=200px;" src="{{$program->image}}"></td>
        </tr>
        <tr>
            <th>Age</th><td>{{$program->age}}</td>
        </tr>
        <tr>
            <th>Type</th><td>{{$program->type}}</td>
        </tr>
        <tr>
            <th>Requirement</th><td>{{$program->requirement}}</td>
        </tr>
        <tr>
            <th>Gender</th><td>{{$program->gender}}</td>
        </tr>
        </tbody>
    </table>
    <?php /*<h3>Image upload</h3>
    <form action="{{route('admin.programs.imageLoad',$program)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>*/ ?>
@endsection
