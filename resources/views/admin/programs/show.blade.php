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
    <?php 
        $Nday=0
    ?>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$program->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$program->name}}</td>
        </tr>
        <tr>
            <th>Text</th><td>{{$program->text}}</td>
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
        @foreach($days as $day)
            <?php $dayexs = $days = App\Entity\Dayexercise::where('day_id',$day->id)->get();?>
            <tr>
                <th>
                    Day <?php $Nday=$Nday+1; ?>{{$Nday}} 
                    <form method="POST" action="{{route('admin.days.update',$day)}}">
                        @csrf
                        @method('DELETE')
                        <button name="program_id" value="{{$program->id}}" class="btn btn-danger">Delete day</button>
                    </form>
                </th>
                <td>
                @foreach($dayexs as $dayex)
                        <?php $exercise=App\Entity\Exercise::where('id',$dayex->exercise_id)->first() ?>
                        <form method="POST" action="{{route('admin.dayexercises.update',$dayex)}}">
                        @csrf
                        @method('PUT')
                            <div class="row">                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select id="exercise_id" class="form-control" name="exercise_id">
                                            @foreach($exercises as $value)
                                                <option value="{{$value->id}}"{{( $value->id == $exercise->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <input id="count" class="form-control" name="count" value="{{old('count') ?? $dayex->count}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <input id="weight" class="form-control" name="weight" value="{{old('weight') ?? $dayex->weight}}">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" name="program_id" value="{{$program->id}}" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                </form>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <form method="POST" action="{{route('admin.dayexercises.update',$dayex)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button name="program_id" value="{{$program->id}}" class="btn btn-danger">Delete exercise</button>
                                        </form>
                                    </div>
                                </div>
                            </div>    
                @endforeach
                </br>
                    <form method="POST" action="{{route('admin.dayexercises.store')}}">
                        @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exercise_id" class="col-form-label">Exercise</label>
                                        <select id="exercise_id" class="form-control" name="exercise_id">
                                            @foreach($exercises as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="count" class="col-form-label">Count</label>
                                        <input id="count" class="form-control" name="count">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="weight" class="col-form-label">Weight</label>
                                        <input id="weight" class="form-control" name="weight">
                                    </div>
                                </div>
                                <input id="program_id" class="form-control" name="program_id" value="{{ $program->id }}" hidden>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" name="day_id" value="{{$day->id}}" class="btn btn-primary">Add Exercise</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($Nday < 7)
    <form method="POST" action="{{route('admin.days.store')}}">
    @csrf
        <div class="form-group">
            <button type="submit" name="program_id" value="{{$program->id}}" class="btn btn-primary">Add day</button>
        </div>
    </form>
    @endif
    <?php /*<h3>Image upload</h3>
    <form action="{{route('admin.programs.imageLoad',$program)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>*/ ?>
@endsection
