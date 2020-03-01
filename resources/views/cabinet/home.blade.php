@extends('layouts.app')

@section('content')
<?php         
    $program = App\Entity\Program::where('id',Auth::user()->program_id)->first();
    $nutrition = App\Entity\Nutrition::where('id',Auth::user()->nutrition_id)->first();
    $user = App\User::where('id',Auth::user()->id)->first();
?>
<div class="container">
    <div class="row justify-content-center">
        <a href="{{route('cabinet.edit',$user)}}" class="btn btn-primary mr-1">Edit</a>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>Name</th><td>{{Auth::user()->name}}</td>
            </tr>
            <tr>
                <th>Email</th><td>{{Auth::user()->email}}</td>
            </tr>
        <tr>
                <th>Gender</th>
                <td>
                    @if(Auth::user()->gender===\App\User::GENDER_WOMAN)
                        <span class="badge badge-primary">Woman</span>
                    @endif
                    @if(Auth::user()->gender===\App\User::GENDER_MAN)
                        <span class="badge badge-primary">Man</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Role</th>
                <td>
                    @if(Auth::user()->role===\App\User::ROLE_USER)
                        <span class="badge badge-secondary">User</span>
                    @endif
                    @if(Auth::user()->role===\App\User::ROLE_ADMIN)
                        <span class="badge badge-primary">Admin</span>
                    @endif
                    @if(Auth::user()->role === \App\User::ROLE_TRAINER)
                        <span class="badge badge-dark">Trainer</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Birthday</th><td>{{Auth::user()->birthday}}</td>
            </tr>
            <tr>
                <th>Program</th>
                    @if(!$program)
                        <td>
                            None
                        </td>
                    @else
                        <td>
                        <a href="{{route('program',$program)}}">{{$program->name}}</a>
                        </td>
                    @endif
            </tr>
            <tr>
                <th>Nutrition</th>
                    @if(!$nutrition)
                        <td>
                            None
                        </td>
                    @else
                        <td>
                        <a href="{{route('nutrition',$nutrition)}}">{{$nutrition->name}}</a>
                        </td>
                    @endif
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
