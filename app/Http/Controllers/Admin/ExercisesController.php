<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Entity\Exercise;
use Illuminate\Validation\Rule;
use Storage;

class ExercisesController extends Controller
{

    public function __construct()
    {
    }
    public function index(Request $request)
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

        if(!empty($value = $request->get('id'))){
            $query->where('id',$value);
        }
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('muscle'))){
            $query->where('muscle',$value);
        }
        $exercises = $query->paginate(20);
        return view('admin.exercises.index',compact('exercises','muscles'));
    }

    public function create()
    {
        $muscles = [
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
        return view('admin.exercises.create',compact('muscles'));
    }

    public function store(Request $request)
    {/*$fileName=null;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads';
            Storage::disk('public')->putFileAs($filePath, $request->file('image'), $fileName);
        }*/
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
            'image'=>'required|string|',
        ]);
        $exercise = Exercise::create([
           'name'=>$request['name'],
            'text'=>$request['text'],
            'image'=>$request['image'],
            'muscle'=>$request['muscle'],
        ]);
        return redirect()->route('admin.exercises.show',$exercise);
    }

    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show',compact('exercise'));
    }

    public function edit(Exercise $exercise)
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
        return view('admin.exercises.edit',compact('exercise','muscles'));
    }

    public function update(Request $request, Exercise $exercise)
    {
       /* $fileName=null;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads';
            Storage::disk('public')->putFileAs($filePath, $request->file('image'), $fileName);
        }*/
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
            'image'=>'required|string',
            'muscle'=>['required','string',Rule::in([Exercise::MUSCLE_NECK,Exercise::MUSCLE_TRAPEZE,Exercise::MUSCLE_SHOULDERS,Exercise::MUSCLE_BICEPS,Exercise::MUSCLE_CHEST,Exercise::MUSCLE_FOREARM,Exercise::MUSCLE_ABS,Exercise::MUSCLE_QUADRICEPS,Exercise::MUSCLE_TRICEPS,Exercise::MUSCLE_LATISSIMUS,Exercise::MUSCLE_MIDDLE_BACK,Exercise::MUSCLE_LOWER_BACK,Exercise::MUSCLE_BUTTOCKS,Exercise::MUSCLE_HIPS,Exercise::MUSCLE_CALVES])],
            ]);
        $exercise->update($data);
        return redirect()->route('admin.exercises.show',$exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('admin.exercises.index');
    }
    public function image(Exercise $exercise){
        return view('admin.exercises.image',compact('exercise'));
    }
    public function imageLoad(Request $request, Exercise $exercise){
            $file = $request->file('image');
            $fileName = time() . $file->getClientOriginalName();
            $filePath = 'uploads';
            Storage::disk('public')->putFileAs($filePath, $request->file('image'), $fileName);
            DB::table('exercises')->where('id',$exercise->id)->update(['image'=>$fileName,]);
        return redirect()->route('admin.exercises.index');
    }
}
