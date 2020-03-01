@extends('layouts.app')
@section('content')
    @include('admin.users._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary mr-1">Edit</a>
        <form method="POST" action="{{route('admin.users.update',$user)}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$user->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{$user->email}}</td>
        </tr>
       <tr>
            <th>Gender</th>
            <td>
                @if($user->gender===\App\User::GENDER_WOMAN)
                    <span class="badge badge-primary">Woman</span>
                @endif
                @if($user->gender===\App\User::GENDER_MAN)
                    <span class="badge badge-primary">Man</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                @if($user->role===\App\User::ROLE_USER)
                    <span class="badge badge-secondary">User</span>
                @endif
                @if($user->role===\App\User::ROLE_ADMIN)
                    <span class="badge badge-primary">Admin</span>
                @endif
                @if($user->role === \App\User::ROLE_TRAINER)
                    <span class="badge badge-dark">Trainer</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Birthday</th><td>{{$user->birthday}}</td>
        </tr>
        </tbody>
    </table>
@endsection
