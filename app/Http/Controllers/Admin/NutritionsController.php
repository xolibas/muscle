<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Nutrition;
use App\Entity\Meal;
use App\Entity\Product;
use App\Entity\Mealproduct;
use Illuminate\Validation\Rule;
use DB;

class NutritionsController extends Controller
{

    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $query = Nutrition::orderByDesc('id');

        if(!empty($value = $request->get('id'))){
            $query->where('id',$value);
        }
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('age'))){
            $query->where('age','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('gender'))){
            $query->where('gender',$value);
        }
        if(!empty($value = $request->get('requirement'))){
            $query->where('requirement',$value);
        }
        $genders = [
            Nutrition::GENDER_MAN=>'Man',
            Nutrition::GENDER_WOMAN=>'Woman',
            Nutrition::GENDER_BOTH=>'Both',
        ];
        $requirements = [
            Nutrition::REQUIREMENT_WEIGHT_GAIN=>'Weight gain',
            Nutrition::REQUIREMENT_WEIGHT_SUPPORT=>'Weight support',
            Nutrition::REQUIREMENT_WEIGHT_LOSS=>"Weight loss",
        ];
        $ages = [
            Nutrition::AGE_CHILDRENS=>'Childrens',
            Nutrition::AGE_OLD_PEOPLE=>'Old people',
            Nutrition::AGE_EVERYBODY=>'Everybody',
            Nutrition::AGE_YOUNG_PEOPLE=>'Young people',
        ];
        $nutritions = $query->paginate(20);
        return view('admin.nutritions.index',compact('nutritions','genders','requirements','ages'));
    }

    public function create()
    {
        $genders = [
            Nutrition::GENDER_MAN=>'Man',
            Nutrition::GENDER_WOMAN=>'Woman',
            Nutrition::GENDER_BOTH=>'Both',
        ];
        $requirements = [
            Nutrition::REQUIREMENT_WEIGHT_GAIN=>'Weight gain',
            Nutrition::REQUIREMENT_WEIGHT_SUPPORT=>'Weight support',
            Nutrition::REQUIREMENT_WEIGHT_LOSS=>"Weight loss",
        ];
        $ages = [
            Nutrition::AGE_CHILDRENS=>'Childrens',
            Nutrition::AGE_OLD_PEOPLE=>'Old people',
            Nutrition::AGE_EVERYBODY=>'Everybody',
            Nutrition::AGE_YOUNG_PEOPLE=>'Young people',
        ];
        return view('admin.nutritions.create',compact('genders','types','requirements','ages'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|max:255',
        ]);
        $nutrition = Nutrition::create([
           'name'=>$request['name'],
            'text'=>$request['text'],
            'age'=>$request['age'],
            'image'=>$request['image'],
            'gender'=>$request['gender'],
            'type'=>$request['type'],
            'requirement'=>$request['requirement'],
        ]);
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

    public function show(Nutrition $nutrition)
    {
        $meals = Meal::where('nutrition_id',$nutrition->id)->get();
        $products = Product::all();
        return view('admin.nutritions.show',compact('nutrition','meals','products'));
    }

    public function edit(Nutrition $nutrition)
    {
        $genders = [
            Nutrition::GENDER_MAN=>'Man',
            Nutrition::GENDER_WOMAN=>'Woman',
            Nutrition::GENDER_BOTH=>'Both',
        ];
        $requirements = [
            Nutrition::REQUIREMENT_WEIGHT_GAIN=>'Weight gain',
            Nutrition::REQUIREMENT_WEIGHT_SUPPORT=>'Weight support',
            Nutrition::REQUIREMENT_WEIGHT_LOSS=>"Weight loss",
        ];
        $ages = [
            Nutrition::AGE_CHILDRENS=>'Childrens',
            Nutrition::AGE_OLD_PEOPLE=>'Old people',
            Nutrition::AGE_EVERYBODY=>'Everybody',
            Nutrition::AGE_YOUNG_PEOPLE=>'Young people',
        ];
        return view('admin.nutritions.edit',compact('nutrition','genders','types','requirements','ages'));
    }

    public function update(Request $request, Nutrition $nutrition)
    {
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'image'=>'required|string',
            'gender'=>['required','string',Rule::in([Nutrition::GENDER_MAN,Nutrition::GENDER_WOMAN,Nutrition::GENDER_BOTH])],
            'age'=>['required','string',Rule::in([Nutrition::AGE_CHILDRENS,Nutrition::AGE_OLD_PEOPLE,Nutrition::AGE_EVERYBODY,Nutrition::AGE_YOUNG_PEOPLE])],
            'requirement'=>['required','string',Rule::in([Nutrition::REQUIREMENT_WEIGHT_GAIN,Nutrition::REQUIREMENT_WEIGHT_SUPPORT,Nutrition::REQUIREMENT_WEIGHT_LOSS])],
        ]);
        $nutrition->update($data);
        return redirect()->route('admin.nutritions.show',$nutrition);
    }

    public function destroy(Nutrition $nutrition)
    {
        $nutrition->delete();
        return redirect()->route('admin.nutritions.index');
    }
}
