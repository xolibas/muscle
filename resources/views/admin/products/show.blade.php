@extends('layouts.app')
@section('content')
    @include('admin.products._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.products.edit',$product)}}" class="btn btn-primary mr-1">Edit</a>
        <form method="POST" action="{{route('admin.products.update',$product)}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$product->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$product->name}}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{$product->text}}</td>
        </tr>
        <tr>
            <th>Image</th><td><img style="width:200px;height=200px;" src="{{$product->image}}"></td>
        </tr>
        <tr>
            <th>Proteins</th><td>{{$product->proteins}}</td>
        </tr>
        <tr>
            <th>Fat</th><td>{{$product->fat}}</td>
        </tr>
        <tr>
            <th>Carbohydrates</th><td>{{$product->carbohydrates}}</td>
        </tr>
        </tbody>
    </table>
@endsection
