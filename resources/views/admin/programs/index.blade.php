@extends('layouts.app')

@section('content')
    @include('admin.programs._nav')
    <p><a href="{{route('admin.programs.create')}}" class="btn btn-success">Create program</a></p>

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
                            <label for="type" class="col-form-label">Type</label>
                            <select id="type" class="form-control" name="type">
                                <option value=""></option>
                                @foreach($types as $value=>$label)
                                    <option value="{{$value}}"{{$value === request('type') ? ' selected'
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
                    <div class="col-sm-2">
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
            <th>Type</th>
            <th>Requirement</th>
            <th>Gender</th>
        </tr>
        </thead>
        <tbody>
        @foreach($programs as $program)
            <tr>
                <td>{{$program->id}}</td>
                <td><a href="{{route('admin.programs.show',$program)}}">{{$program->name}}</a></td>
                <td>{{$program->text}}</td>
                <td><img style="width:200px;height=200px;" src="{{$program->image}}"></td>
                <td>{{$program->age}}</td>
                <td>{{$program->type}}</td>
                <td>{{$program->requirement}}</td>
                <td>{{$program->gender}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$programs->links()}}
@endsection
