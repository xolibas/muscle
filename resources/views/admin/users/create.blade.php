@extends('layouts.app')

@section('content')
    @include('admin.users._nav')

    <form method="POST" action="{{route('admin.users.store')}}">
        @csrf

        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{$errors->has('name')?' is-invalid' : '' }}" name="name"
            value="{{ old('name') }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input id="email" class="form-control{{$errors->has('email')?' is-invalid' : '' }}" name="email"
                   value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback"><strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input id="password" class="form-control{{$errors->has('password')?' is-invalid' : '' }}" name="password"
                   value="{{ old('password') }}" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback"><strong>{{$errors->first('password')}}</strong></span>
            @endif
        </div>
        <div class="form-group">
            <label for="gender" class="col-form-label">Gender</label>
            <select id="gender" type="email" class="form-control" name="gender">
                @foreach($genders as $value => $label)
                    <option value="{{$value}}"{{$value===old('status')?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select id="role" type="email" class="form-control" name="role">
                @foreach($roles as $value => $label)
                    <option value="{{$value}}"{{$value===old('role')?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
