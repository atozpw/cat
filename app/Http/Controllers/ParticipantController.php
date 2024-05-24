<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = User::where('is_member', '1')->orderBy('number', 'desc')->paginate(20);

        $max_number = User::max('number');

        $number = (substr($max_number, 0, 2) == date('y')) ? $max_number + 1 : date('y') . '0001';

        return view('participants.index', compact('participants', 'number'));
    }

    public function store(Request $request)
    {
        $password = Hash::make($request->number);

        $request->request->add(['is_member' => 1, 'password' => $password]);

        User::create($request->all());

        toastr()->success('Peserta baru berhasil ditambah.');

        return redirect(route('participants.index'));
    }

    public function edit($id)
    {
        $participant = User::find($id);

        return response($participant);
    }

    public function update(Request $request, $id)
    {
        $participant = User::find($id);

        $participant->update($request->all());

        toastr()->success('Peserta berhasil diperbaharui.');

        return redirect(route('participants.index'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        toastr()->success('Peserta berhasil dihapus.');

        return redirect(route('participants.index'));
    }
}
