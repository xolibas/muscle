@extends('layouts.app')

@section('content')
    @include('admin.products._nav')

    <form method="POST" action="{{route('admin.products.store')}}">
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
            <label for="text" class="col-form-label">Text</label>
            <input id="text" class="form-control{{$errors->has('text')?' is-invalid' : '' }}" name="text"
                   value="{{ old('text') }}" required>
            @if ($errors->has('text'))
                <span class="invalid-feedback"><strong>{{$errors->first('text')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label">Image</label>
            <input id="image" class="form-control{{$errors->has('image')?' is-invalid' : '' }}" name="image"
                   value="{{ old('image') }}" required>
            @if ($errors->has('image'))
                <span class="invalid-feedback"><strong>{{$errors->first('image')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="proteins" class="col-form-label">Proteins</label>
            <input id="proteins" class="form-control{{$errors->has('proteins')?' is-invalid' : '' }}" name="proteins"
                   value="{{ old('proteins') }}" required>
            @if ($errors->has('proteins'))
                <span class="invalid-feedback"><strong>{{$errors->first('proteins')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="fat" class="col-form-label">Fat</label>
            <input id="fat" class="form-control{{$errors->has('fat')?' is-invalid' : '' }}" name="fat"
                   value="{{ old('fat') }}" required>
            @if ($errors->has('fat'))
                <span class="invalid-feedback"><strong>{{$errors->first('fat')}}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="carbohydrates" class="col-form-label">Carbohydrates</label>
            <input id="carbohydrates" class="form-control{{$errors->has('carbohydrates')?' is-invalid' : '' }}" name="carbohydrates"
                   value="{{ old('carbohydrates') }}" required>
            @if ($errors->has('carbohydrates'))
                <span class="invalid-feedback"><strong>{{$errors->first('carbohydrates')}}</strong></span>
            @endif
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
