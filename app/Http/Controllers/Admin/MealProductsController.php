<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Nutrition;
use App\Entity\Meal;
use App\Entity\Mealproduct;
use App\Entity\Product;
use Illuminate\Validation\Rule;
use DB;

class MealProductsController extends Controller
{

    public function __construct()
    {
    }
    public function store(Request $request)
    {
        $mealproduct = Mealproduct::create([
            'meal_id'=>$request['meal_id'],
            'product_id'=>$request['product_id'],
            'weight'=>$request['weight'],
        ]);
        $nutrition = Nutrition::where('id',$request['nutrition_id'])->first();
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

    public function destroy(Request $request,Mealproduct $mealproduct)
    {
        $mealproduct->delete();
        $nutrition = Nutrition::where('id',$request['nutrition_id'])->first();
        return redirect()->route('admin.nutritions.show',$nutrition);
    }
    public function update(Request $request,Mealproduct $mealproduct)
    {
        $data = $this->validate($request,[
            'product_id'=>'required|integer',
            'weight'=>'integer',
            ]);
        $nutrition = Nutrition::where('id',$request['nutrition_id'])->first();
        $mealproduct->update($data);
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

}
