<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Program;
use App\Entity\Nutrition;
use App\User;
class HomeController extends Controller
{

    public function __construct()
    {
    }
    public function index()
    {
        return view('admin.home');
    }
}
