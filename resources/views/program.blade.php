@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <?php $Nday=0;?>
    @guest
    <h3>Login to add this program</h3>
    @else
    <?php $user = App\User::where('id',Auth::user()->id)->first(); ?>
    <form method="POST" action="{{route('program.add',$user)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <button id="program_id" name="program_id" value="{{$program->id}}" type="submit" class="btn btn-primary">Select</button>
        </div>
    </form>
    @endguest
    <table class="table table-bordered table-striped">
        <tbody>
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
                </th>
                <td>
                @foreach($dayexs as $dayex)
                        <?php $exercise=App\Entity\Exercise::where('id',$dayex->exercise_id)->first() ?>
                            <div class="row">                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <a href="{{route('exercise',$exercise)}}">{{$exercise->name}}</a>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        {{$dayex->count}}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        {{$dayex->weight}}
                                    </div>
                                </div>
                            </div>    
                @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection