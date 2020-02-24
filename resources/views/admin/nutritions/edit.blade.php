@extends('layouts.app')

@section('content')
    @include('admin.nutritions._nav')

    <form method="POST" action="{{route('admin.nutritions.update',$nutrition)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{$errors->has('name')?' is-invalid' : '' }}" name="name"
                   value="{{ old('name',$nutrition->name) }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="text" class="col-form-label">Text</label>
            <input id="text" type="text" class="form-control{{$errors->has('text')?' is-invalid' : '' }}" name="text"
                   value="{{ old('text',$nutrition->text) }}" required>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{$errors->first('text')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">Image</label>
            <input id="image"class="form-control{{$errors->has('image')?' is-invalid' : '' }}" name="image"
                   value="{{ old('image',$nutrition->image) }}" required>
            @if ($errors->has('image'))
                <span class="invalid-feedback"><strong>{{$errors->first('image')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="age" class="col-form-label">Age</label>
            <select id="age" class="form-control{{$errors->has('age')?'is-invalid':''}}" name="age">
                @foreach($ages as $value => $label)
                    <option value="{{$value}}"{{$value===old('age',$nutrition->age)?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('age'))
                <span class="invalid-feedback"><strong>{{$errors->first('age')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="requirement" class="col-form-label">Requirement</label>
            <select id="requirement" class="form-control{{$errors->has('requirement')?'is-invalid':''}}" name="requirement">
                @foreach($requirements as $value => $label)
                    <option value="{{$value}}"{{$value===old('requirement',$nutrition->requirement)?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('requirement'))
                <span class="invalid-feedback"><strong>{{$errors->first('requirement')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="gender" class="col-form-label">Gender</label>
            <select id="gender" class="form-control{{$errors->has('gender')?'is-invalid':''}}" name="gender">
                @foreach($genders as $value => $label)
                    <option value="{{$value}}"{{$value===old('gender',$nutrition->gender)?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('gender'))
                <span class="invalid-feedback"><strong>{{$errors->first('gender')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
