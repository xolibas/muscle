<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Program;
use App\User;
use App\Entity\Nutrition;
use App\Controllers\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('cabinet.home');
    }

    public function edit(User $user)
    {
       $genders = [
            User::GENDER_MAN=>'Man',
            User::GENDER_WOMAN=>'Woman',
        ];
        return view('cabinet.edit',compact('user','genders'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users,id,' . $user->id,
            'gender'=>['required','string',Rule::in([User::GENDER_MAN,User::GENDER_WOMAN])],
            'birthday'=>['nullable','date'],
        ]);
        $user->update($data);
        return redirect()->route('cabinet.home');
    }
}
