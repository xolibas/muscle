<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Program;
use App\Entity\Day;
use App\Entity\Exercise;
use App\Entity\DayExercise;
use Illuminate\Validation\Rule;

class ProgramsController extends Controller
{

    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $query = Program::orderByDesc('id');

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
        return view('admin.programs.index',compact('programs','genders','types','requirements','ages'));
    }

    public function create()
    {
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
        return view('admin.programs.create',compact('genders','types','requirements','ages'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|max:255',
        ]);
        $program = Program::create([
           'name'=>$request['name'],
            'text'=>$request['text'],
            'age'=>$request['age'],
            'image'=>$request['image'],
            'gender'=>$request['gender'],
            'type'=>$request['type'],
            'requirement'=>$request['requirement'],
        ]);
        return redirect()->route('admin.programs.show',$program);
    }

    public function storeDay(Request $request,Program $program)
    {
        $day = Day::create([
            'program_id'=>$program->id,
        ]);
        return redirect()->route('admin.programs.show',$program);
    }

    public function destroyDay(Request $request,Program $program,Day $day)
    {
        $day->delete();
        return redirect()->route('admin.programs.show',$program);
    }

    public function storeDayExercise(Request $request,Program $program,Exercise $exercise)
    {
        $dayex = DayExercise::create([
            'exercise_id'=>$exercise->id,
            'day_id'=>$exercise->id,
        ]);
        return redirect()->route('admin.programs.show',$program);
    }

    public function destroyDayExercise(Request $request,Program $program,DayExercise $dayex)
    {
        $dayex->delete();
        return redirect()->route('admin.programs.show',$program);
    }

    public function show(Program $program)
    {
        $days = Day::orderByDesc('id')->where('program_id',$program->id);
        return view('admin.programs.show',compact('program'));
    }

    public function edit(Program $program)
    {
        $genders = [
            Program::GENDER_MAN=>'Man',
            Program::GENDER_WOMAN=>'Woman',
            Program::GENDER_BOTH=>'Both',
        ];
        $types = [
            Program::TYPE_GYM=>'Gym',
            Program::TYPE_HOME=>'Home',
            Program::TYPE_BOTH=>'Both',
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
        return view('admin.programs.edit',compact('program','genders','types','requirements','ages'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'image'=>'required|string',
            'gender'=>['required','string',Rule::in([Program::GENDER_MAN,Program::GENDER_WOMAN,Program::GENDER_BOTH])],
            'age'=>['required','string',Rule::in([Program::AGE_CHILDRENS,Program::AGE_OLD_PEOPLE,Program::AGE_EVERYBODY,Program::AGE_YOUNG_PEOPLE])],
            'requirement'=>['required','string',Rule::in([Program::REQUIREMENT_WEIGHT_GAIN,Program::REQUIREMENT_WEIGHT_SUPPORT,Program::REQUIREMENT_WEIGHT_LOSS])],
            'type'=>['required','string',Rule::in([Program::TYPE_GYM,Program::TYPE_HOME,Program::TYPE_BOTH])],
        ]);
        $program->update($data);
        return redirect()->route('admin.programs.show',$program);
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('admin.programs.index');
    }
}
