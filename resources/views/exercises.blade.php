@extends('layouts.app')

@section('content')
        <div class="card mb-3">
        <div class="card-header">Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" class="form-control" name="name" value="{{request('name')}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="muscle" class="col-form-label">Muscle</label>
                            <select id="muscle" class="form-control" name="muscle">
                                <option value=""></option>
                                @foreach($muscles as $value=>$label)
                                    <option value="{{$value}}"{{$value === request('muscle') ? ' selected'
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
    <div class="container">
        <div class="row justify-content-center">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Text</th>
            <th>Image</th>
            <th>Muscle</th>
        </tr>
        </thead>
        <tbody>
        @foreach($exercises as $exercise)
            <tr>
                <td><a href="{{route('exercise',$exercise)}}">{{$exercise->name}}</a></td>
                <td>{{$exercise->text}}</td>
                <td><img style="width:200px;height=200px;" src="{{$exercise->image}}"></td>
                <td>{{$exercise->muscle}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
    </div>
@endsection
