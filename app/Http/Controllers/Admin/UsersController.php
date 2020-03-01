<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user-manage');
    }
    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if(!empty($value = $request->get('id'))){
            $query->where('id',$value);
        }
        if(!empty($value = $request->get('name'))){
            $query->where('name','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('email'))){
            $query->where('email','like','%'.$value.'%');
        }
        if(!empty($value = $request->get('gender'))){
            $query->where('gender',$value);
        }
        if(!empty($value = $request->get('role'))){
            $query->where('role',$value);
        }
        $genders = [
            User::GENDER_MAN=>'Man',
            User::GENDER_WOMAN=>'Woman',
        ];
        $roles = [
            User::ROLE_TRAINER=>'Trainer',
            User::ROLE_USER=>'User',
            User::ROLE_ADMIN=>'Admin',
        ];
        $users = $query->paginate(20);
        return view('admin.users.index',compact('users','genders','roles'));
    }

    public function create()
    {
        $genders = [
            User::GENDER_MAN=>'Man',
            User::GENDER_WOMAN=>'Woman',
        ];
        $roles = [
            User::ROLE_TRAINER=>'Trainer',
            User::ROLE_USER=>'User',
            User::ROLE_ADMIN=>'Admin',
        ];
        return view('admin.users.create',compact('genders','roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'birthday'=>'nullable|date' 
        ]);
        $user = User::create([
           'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>$request['password'],
            'gender'=>$request['gender'],
            'role'=>$request['role'],
            'birthday'=>$request['birthday']
        ]);
        return redirect()->route('admin.users.show',$user);
    }

    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    public function edit(User $user)
    {
       $genders = [
            User::GENDER_MAN=>'Man',
            User::GENDER_WOMAN=>'Woman',
        ];
       $roles = [
           User::ROLE_TRAINER=>'Trainer',
           User::ROLE_USER=>'User',
           User::ROLE_ADMIN=>'Admin',
       ];
        return view('admin.users.edit',compact('user','genders','roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users,id,' . $user->id,
            'gender'=>['required','string',Rule::in([User::GENDER_MAN,User::GENDER_WOMAN])],
            'role'=>['required','string',Rule::in([User::ROLE_ADMIN,User::ROLE_USER,User::ROLE_TRAINER])],
            'birthday'=>['nullable','date'],
        ]);
        $user->update($data);
        return redirect()->route('admin.users.show',$user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
