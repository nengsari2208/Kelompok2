<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
class HomeController extends Controller
{
    //
    public function index(){
        if(Auth::user()->department->nama_departemen == "HR"){
            return view('/hr-home');
        } elseif(Auth::user()->department->nama_departemen == "FINANCE") {
            return view('/fin-home');
        } else {
            return view('/home');
        }
    }
}
