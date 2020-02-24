@extends('layouts.app')

@section('content')
    @include('admin.products._nav')
    <p><a href="{{route('admin.products.create')}}" class="btn btn-success">Create product</a></p>

    <div class="card mb-3">
        <div class="card-header">Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{request('id')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" class="form-control" name="name" value="{{request('name')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Text</th>
            <th>Image</th>
            <th>Proteins</th>
            <th>Fat</th>
            <th>Carbohydrates</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td><a href="{{route('admin.products.show',$product)}}">{{$product->name}}</a></td>
                <td>{{$product->text}}</td>
                <td><img style="width:200px;height=200px;" src="{{$product->image}}"></td>
                <td>{{$product->proteins}}</td>
                <td>{{$product->fat}}</td>
                <td>{{$product->carbohydrates}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection
