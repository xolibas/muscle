@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link active" href="{{route('admin.home')}}">Dashboard</a></li>
        @can('user-manage')<li class="nav-item"><a class="nav-link" href="{{route('admin.users.index')}}">Users</a></li>@endcan
        <li class="nav-item"><a class="nav-link" href="{{route('admin.exercises.index')}}">Exercises</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('admin.programs.index')}}">Programs</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('admin.nutritions.index')}}">Nutritions</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
    </ul>
    <h1>{{App\Entity\Program::count()}} programs</h1><br><br>
    <h1>{{App\Entity\Nutrition::count()}} nutritions</h1><br><br>
    <h1>{{App\User::count()}} users</h1>
@endsection
