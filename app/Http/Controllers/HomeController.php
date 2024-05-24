<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $aspect = Aspect::find(1);
        // dd($aspect->parameter_bottom);
        return view('home');
    }
}
