@extends('layouts.app')

@section('content')
    @include('admin.nutritions._nav')
    <p><a href="{{route('admin.nutritions.create')}}" class="btn btn-success">Create nutrition</a></p>

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
                            <label for="age" class="col-form-label">Age</label>
                            <select id="age" class="form-control" name="age">
                                <option value=""></option>
                                @foreach($ages as $value=>$label)
                                    <option value="{{$value}}"{{$value === request('age') ? ' selected'
: ''}}>{{$label}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="requirement" class="col-form-label">Requirement</label>
                            <select id="requirement" class="form-control" name="requirement">
                                <option value=""></option>
                                @foreach($requirements as $value=>$label)
                                    <option value="{{$value}}"{{$value === request('requirement') ? ' selected'
: ''}}>{{$label}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender</label>
                            <select id="gender" class="form-control" name="gender">
                                <option value=""></option>
                                @foreach($genders as $value=>$label)
                                    <option value="{{$value}}"{{$value === request('gender') ? ' selected'
: ''}}>{{$label}}</option>
                                    @endforeach
                            </select>
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
            <th>Age</th>
            <th>Requirement</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        @foreach($nutritions as $nutrition)
            <tr>
                <td>{{$nutrition->id}}</td>
                <td><a href="{{route('admin.nutritions.show',$nutrition)}}">{{$nutrition->name}}</a></td>
                <td>{{$nutrition->text}}</td>
                <td><img style="width:200px;height=200px;" src="{{$nutrition->image}}"></td>
                <td>{{$nutrition->age}}</td>
                <td>{{$nutrition->requirement}}</td>
                <td>{{$nutrition->gender}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$nutritions->links()}}
@endsection
