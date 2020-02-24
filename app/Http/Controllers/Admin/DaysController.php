<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Program;
use App\Entity\Day;
use App\Entity\Dayexercise;
use Illuminate\Validation\Rule;
use DB;

class DaysController extends Controller
{

    public function __construct()
    {
    }
    public function store(Request $request)
    {
        $day = Day::create([
            'program_id'=>$request['program_id'],
        ]);
        $program = Program::where('id',$request['program_id'])->first();
        return redirect()->route('admin.programs.show',$program);
    }

    public function destroy(Request $request,Day $day)
    {
        $day->delete();
        $program = Program::where('id',$request['program_id'])->first();
        return redirect()->route('admin.programs.show',$program);
    }
    public function update(Request $request,Day $day)
    {
        $data = $this->validate($request,[
            'program_id'=>'required|int',
            ]);
        $day->update($data);
        return redirect()->route('admin.programs.show',$program);
    }
    /*public function index(Request $request)
    {
        $query = Day::orderByDesc('id');
        $days = $query->paginate(20);
        return view('admin.days.index',compact('days'));
    }

    public function create()
    {
        return view('admin.days.create');
    }

    public function show(Day $day)
    {
        return view('admin.days.show',compact('day'));
    }

    public function edit(Day $day)
    {
        return view('admin.days.edit',compact('day'));
    }

*/

}
