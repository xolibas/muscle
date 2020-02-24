<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Program;
use App\Entity\Day;
use App\Entity\Dayexercise;
use App\Entity\Exercise;
use Illuminate\Validation\Rule;
use DB;

class DayExercisesController extends Controller
{

    public function __construct()
    {
    }
    public function store(Request $request)
    {
        $dayexercise = Dayexercise::create([
            'day_id'=>$request['day_id'],
            'exercise_id'=>$request['exercise_id'],
            'count'=>$request['count'],
            'weight'=>$request['weight'],
        ]);
        $program = Program::where('id',$request['program_id'])->first();
        return redirect()->route('admin.programs.show',$program);
    }

    public function destroy(Request $request,Dayexercise $dayexercise)
    {
        $dayexercise->delete();
        $program = Program::where('id',$request['program_id'])->first();
        return redirect()->route('admin.programs.show',$program);
    }
    public function update(Request $request,Dayexercise $dayexercise)
    {
        $data = $this->validate($request,[
            'exercise_id'=>'required|integer',
            'count'=>'integer',
            'weight'=>'integer',
            ]);
        $program = Program::where('id',$request['program_id'])->first();
        $dayexercise->update($data);
        return redirect()->route('admin.programs.show',$program);
    }

}
