@extends('layouts.app')

@section('content')
    @include('admin.exercises._nav')

<div class="container">
    <h1>Image upload</h1>
    <form action="{{route('admin.exercises.imageLoad',$exercise)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>
</div>
@endsection
