<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $query = Exercise::orderByDesc('id');

        if(!empty($value = $request->get('id'))){
            $query->where('id',$value);
        }
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        $exercises = $query->paginate(20);
        return view('admin.exercises.index',compact('exercises'));
    }

    public function create()
    {
        return view('admin.exercises.create');
    }

    public function store(Request $request)
    {$fileName=null;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads';
            Storage::disk('public')->putFileAs($filePath, $request->file('image'), $fileName);
        }
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
        ]);
        $exercise = Exercise::create([
           'name'=>$request['name'],
            'text'=>$request['text'],
            'image'=> $fileName,
        ]);
        return redirect()->route('admin.exercises.show',$exercise);
    }

    public function show(Exercise $exercise)
    {
        return view('admin.exercises.show',compact('exercise'));
    }

    public function edit(Exercise $exercise)
    {
        return view('admin.exercises.edit',compact('exercise'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $fileName=null;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads';
            Storage::disk('public')->putFileAs($filePath, $request->file('image'), $fileName);
        }
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'text'=>'required|string|',
            'image'=>$fileName,
            ]);
        $exercise->update($data);
        return redirect()->route('admin.exercises.show',$exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();
        return redirect()->route('admin.exercises.index');
    }
}
