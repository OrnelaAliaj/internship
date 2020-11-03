<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator'); //middleware applies to all actions in AdminController
    }
    public function index()
    {
        return view('admin.index'); //  when index function called it returns the admin.index view
    }
    

}
