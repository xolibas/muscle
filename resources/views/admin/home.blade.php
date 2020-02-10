@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="{{route('admin.home')}}">Dashboard</a></li>
        @can('user-manage')<li class="nav-item"><a class="nav-link" href="{{route('admin.users.index')}}">Users</a></li>@endcan
        <li class="nav-item"><a class="nav-link" href="{{route('admin.exercises.index')}}">Exercises</a></li>
    </ul>
@endsection
