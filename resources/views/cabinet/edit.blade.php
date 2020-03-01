@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <form method="POST" action="{{route('cabinet.update',$user)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{$errors->has('name')?' is-invalid' : '' }}" name="name"
                   value="{{ old('name',$user->name) }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-form-label">E-Mail Address</label>
            <input id="email" type="email" class="form-control{{$errors->has('email')?' is-invalid' : '' }}" name="email"
                   value="{{ old('email',$user->email) }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback"><strong>{{$errors->first('email')}}</strong></span>
            @endif
        </div>

      <div class="form-group">
            <label for="gender" class="col-form-label">Gender</label>
            <select id="gender" class="form-control{{$errors->has('gender')?'is-invalid':''}}" name="gender">
                @foreach($genders as $value => $label)
                    <option value="{{$value}}"{{$value===old('status',$user->gender)?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('gender'))
                <span class="invalid-feedback"><strong>{{$errors->first('gender')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="birthday" class="col-form-label">Birthday</label>
            <input id="birthday" type="date" class="form-control{{$errors->has('birthday')?' is-invalid' : '' }}" name="birthday"
                   value="{{ $user->birthday }}" required>
            @if ($errors->has('birthday'))
                <span class="invalid-feedback"><strong>{{$errors->first('birthday')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
</div>
@endsection
