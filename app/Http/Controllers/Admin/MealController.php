<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Nutrition;
use App\Entity\Meal;
use App\Entity\Mealproduct;
use Illuminate\Validation\Rule;
use DB;

class MealController extends Controller
{

    public function __construct()
    {
    }
    public function store(Request $request)
    {
        $Meal = Meal::create([
            'nutrition_id'=>$request['nutrition_id'],
        ]);
        $nutrition = Nutrition::where('id',$request['nutrition_id'])->first();
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

    public function destroy(Request $request,Meal $meal)
    {
        $meal->delete();
        $nutrition = Nutrition::where('id',$request['nutrition_id'])->first();
        return redirect()->route('admin.nutritions.show',$nutrition);
    }
    public function update(Request $request,Meal $meal)
    {
        $data = $this->validate($request,[
            'nutrition_id'=>'required|int',
            ]);
        $meal->update($data);
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

}
