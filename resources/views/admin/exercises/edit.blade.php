@extends('layouts.app')

@section('content')
    @include('admin.exercises._nav')

    <form method="POST" action="{{route('admin.exercises.update',$exercise)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="col-form-label">Name</label>
            <input id="name" class="form-control{{$errors->has('name')?' is-invalid' : '' }}" name="name"
                   value="{{ old('name',$exercise->name) }}" required>
            @if ($errors->has('name'))
                <span class="invalid-feedback"><strong>{{$errors->first('name')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="text" class="col-form-label">Text</label>
            <input id="text" type="text" class="form-control{{$errors->has('text')?' is-invalid' : '' }}" name="text"
                   value="{{ old('text',$exercise->text) }}" required>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{$errors->first('text')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">Image</label>
            <input id="image"class="form-control{{$errors->has('image')?' is-invalid' : '' }}" name="image"
                   value="{{ old('image',$exercise->image) }}" required>
            @if ($errors->has('image'))
                <span class="invalid-feedback"><strong>{{$errors->first('image')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="muscle" class="col-form-label">Muscle</label>
            <select id="muscle" class="form-control{{$errors->has('muscle')?'is-invalid':''}}" name="muscle">
                @foreach($muscles as $value => $label)
                    <option value="{{$value}}"{{$value===old('muscle',$exercise->muscle)?' selected' : ''}}>{{$label}}</option>
                @endforeach
            </select>
            @if ($errors->has('muscle'))
                <span class="invalid-feedback"><strong>{{$errors->first('muscle')}}</strong></span>
            @endif
        </div>

     <?php /*   <div class="form-group">
            <label for="image" class="col-form-label">Image</label>
            <input id="image" type="file" class="form-control{{$errors->has('image')?' is-invalid' : '' }}" multiple name="image[]"
                   value="{{ old('image',$exercise->image) }}" required>
            @if ($errors->has('image'))
                <span class="invalid-feedback"><strong>{{$errors->first('image')}}</strong></span>
            @endif
        </div>*/ ?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
