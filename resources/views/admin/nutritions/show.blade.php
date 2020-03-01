@extends('layouts.app')
@section('content')
    @include('admin.nutritions._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{route('admin.nutritions.edit',$nutrition)}}" class="btn btn-primary mr-1">Edit</a>
        <form method="POST" action="{{route('admin.nutritions.update',$nutrition)}}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
    <?php 
        $Nmeal=0
    ?>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{$nutrition->id}}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{$nutrition->name}}</td>
        </tr>
        <tr>
            <th>Text</th><td>{{$nutrition->text}}</td>
        </tr>
        <tr>
            <th>Image</th><td><img style="width:200px;height=200px;" src="{{$nutrition->image}}"></td>
        </tr>
        <tr>
            <th>Age</th><td>{{$nutrition->age}}</td>
        </tr>
        <tr>
            <th>Requirement</th><td>{{$nutrition->requirement}}</td>
        </tr>
        <tr>
            <th>Gender</th><td>{{$nutrition->gender}}</td>
        </tr>
        @foreach($meals as $meal)
            <?php $mealprs = $meals = App\Entity\Mealproduct::where('meal_id',$meal->id)->get();?>
            <tr>
                <th>
                    Meal <?php $Nmeal=$Nmeal+1; ?>{{$Nmeal}} 
                    <form method="POST" action="{{route('admin.meals.update',$meal)}}">
                        @csrf
                        @method('DELETE')
                        <button name="nutrition_id" value="{{$nutrition->id}}" class="btn btn-danger">Delete meal</button>
                    </form>
                </th>
                <td>
                @foreach($mealprs as $mealpr)
                        <?php $product=App\Entity\Product::where('id',$mealpr->product_id)->first() ?>
                        <form method="POST" action="{{route('admin.mealproducts.update',$mealpr)}}">
                        @csrf
                        @method('PUT')
                            <div class="row">                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select id="product_id" class="form-control" name="product_id">
                                            @foreach($products as $value)
                                                <option value="{{$value->id}}"{{( $value->id == $product->id) ? 'selected' : ''}}>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <input id="weight" class="form-control" name="weight" value="{{old('weight') ?? $mealpr->weight}}">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <button type="submit" name="nutrition_id" value="{{$nutrition->id}}" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                </form>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <form method="POST" action="{{route('admin.mealproducts.update',$mealpr)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button name="nutrition_id" value="{{$nutrition->id}}" class="btn btn-danger">Delete product</button>
                                        </form>
                                    </div>
                                </div>
                            </div>    
                @endforeach
                </br>
                    <form method="POST" action="{{route('admin.mealproducts.store')}}">
                        @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="product_id" class="col-form-label">product</label>
                                        <select id="product_id" class="form-control" name="product_id">
                                            @foreach($products as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="weight" class="col-form-label">Weight</label>
                                        <input id="weight" class="form-control" name="weight">
                                    </div>
                                </div>
                                <input id="nutrition_id" class="form-control" name="nutrition_id" value="{{ $nutrition->id }}" hidden>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-form-label">&nbsp;</label><br />
                                        <button type="submit" name="meal_id" value="{{$meal->id}}" class="btn btn-primary">Add product</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($Nmeal < 7)
    <form method="POST" action="{{route('admin.meals.store')}}">
    @csrf
        <div class="form-group">
            <button type="submit" name="nutrition_id" value="{{$nutrition->id}}" class="btn btn-primary">Add meal</button>
        </div>
    </form>
    @endif
    <?php /*<h3>Image upload</h3>
    <form action="{{route('admin.nutritions.imageLoad',$nutrition)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>*/ ?>
@endsection
