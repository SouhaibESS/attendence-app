<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filiere;

class FiliereController extends Controller
{
    public function create()
    {
        return view('admin.filiere.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Filiere::create(['filiere' => $request['name']]);
        $request->session()->flash('success', 'filiere' . $request['name'] . 'created!');
        return redirect(route('users.index'));
    }

    public function show(Filiere $filiere)
    {
        return view('admin.filiere.show', compact('filiere'));  
    }
}
