@extends('layouts.app')

@section('content')
    @include('admin.exercises._nav')
    <p><a href="{{route('admin.exercises.create')}}" class="btn btn-success">Create exercise</a></p>

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
        </tr>
        </thead>
        <tbody>
        @foreach($exercises as $exercise)
            <tr>
                <td>{{$exercise->id}}</td>
                <td><a href="{{route('admin.exercises.show',$exercise)}}">{{$exercise->name}}</a></td>
                <td>{{$exercise->text}}</td>
                <td><img src="{{$exercise->image}}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$exercises->links()}}
@endsection
