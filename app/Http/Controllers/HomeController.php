<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Program;
use App\Entity\Nutrition;
use App\Entity\Day;
use App\Entity\Exercise;
use App\Entity\Product;
use App\Entity\Meal;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function program(Program $program)
    {
        $days = Day::where('program_id',$program->id)->get();
        $exercises = Exercise::all();
        return view('program',compact('program','exercises','days'));
    }

    public function nutrition(Nutrition $nutrition)
    {
        $meals = Meal::where('nutrition_id',$nutrition->id)->get();
        $products = Product::all();
        return view('nutrition',compact('nutrition','products','meals'));
    }

    public function exercise(Exercise $exercise)
    {
        return view('exercise',compact('exercise'));
    }

    public function programs(Request $request)
    {
        $query = Program::orderByDesc('name');
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('age'))){
            $query->where('age','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('gender'))){
            $query->where('gender',$value);
        }
        if(!empty($value = $request->get('type'))){
            $query->where('type',$value);
        }
        if(!empty($value = $request->get('requirement'))){
            $query->where('requirement',$value);
        }
        $genders = [
            Program::GENDER_MAN=>'Man',
            Program::GENDER_WOMAN=>'Woman',
            Program::GENDER_BOTH=>'Both',
        ];
        $types = [
            Program::TYPE_GYM=>"Gym",
            Program::TYPE_HOME=>"Home",
            Program::TYPE_BOTH=>"Both",
        ];
        $requirements = [
            Program::REQUIREMENT_WEIGHT_GAIN=>'Weight gain',
            Program::REQUIREMENT_WEIGHT_SUPPORT=>'Weight support',
            Program::REQUIREMENT_WEIGHT_LOSS=>"Weight loss",
        ];
        $ages = [
            Program::AGE_CHILDRENS=>'Childrens',
            Program::AGE_OLD_PEOPLE=>'Old people',
            Program::AGE_EVERYBODY=>'Everybody',
            Program::AGE_YOUNG_PEOPLE=>'Young people',
        ];
        $programs = $query->paginate(20);
        return view('programs',compact('programs','genders','types','requirements','ages'));
    }

    public function nutritions(Request $request)
    {
        $query = Nutrition::orderByDesc('name');
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
        return view('nutritions',compact('nutritions','genders','requirements','ages'));
    }

    public function exercises(Request $request)
    {
        $muscles=[
            Exercise::MUSCLE_NECK=>'Neck',
            Exercise::MUSCLE_TRAPEZE=>'Trapeze',
            Exercise::MUSCLE_SHOULDERS=>'Shoulders',
            Exercise::MUSCLE_BICEPS=>'Biceps',
            Exercise::MUSCLE_CHEST=>'Chest',
            Exercise::MUSCLE_FOREARM=>'Forearm',
            Exercise::MUSCLE_ABS=>'Abs',
            Exercise::MUSCLE_QUADRICEPS=>'Quadriceps',
            Exercise::MUSCLE_TRICEPS=>'Triceps',
            Exercise::MUSCLE_LATISSIMUS=>'Latissimus',
            Exercise::MUSCLE_MIDDLE_BACK=>'Middle back',
            Exercise::MUSCLE_LOWER_BACK=>'Lower back',
            Exercise::MUSCLE_BUTTOCKS=>'Buttocks',
            Exercise::MUSCLE_HIPS=>'Hips',
            Exercise::MUSCLE_CALVES=>'Calves',
        ];
        $query = Exercise::orderByDesc('id');
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('muscle'))){
            $query->where('muscle',$value);
        }
        $exercises = $query->paginate(20);
        return view('exercises',compact('exercises','muscles'));
    }

    public function addnut(Request $request,User $user)
    {
        $data = $this->validate($request,[
            'nutrition_id'=>'required',
        ]);
        $user->update($data);
        return redirect()->route('cabinet.home');
    }

    public function addprog(Request $request,User $user)
    {
        $data = $this->validate($request,[
            'program_id'=>'required',
        ]);
        $user->update($data);
        return redirect()->route('cabinet.home');
    }
}
