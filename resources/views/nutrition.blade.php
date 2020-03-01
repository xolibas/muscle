@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <?php $Nmeal=0;?>
    @guest
    <h3>Login to add this program</h3>
    @else
    <?php $user = App\User::where('id',Auth::user()->id)->first(); ?>
    <form method="POST" action="{{route('nutrition.add',$user)}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <button id="nutrition_id" name="nutrition_id" value="{{$nutrition->id}}" type="submit" class="btn btn-primary">Select</button>
        </div>
    </form>
    @endguest
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
                </th>
                <td>
                @foreach($mealprs as $mealpr)
                        <?php $product=App\Entity\Product::where('id',$mealpr->product_id)->first() ?>
                        <form method="POST" action="{{route('admin.mealproducts.update',$mealpr)}}">
                            <div class="row">                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{$product->name}}
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        {{$product->weight}}
                                    </div>
                                </div>
                            </div>    
                @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection