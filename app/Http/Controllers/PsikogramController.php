<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PsikogramController extends Controller
{
    public function index()
    {
        $participants = User::where('is_member', 1)->orderBy('name')->get();

        return view('psikograms.index', compact('participants'));
    }
}
