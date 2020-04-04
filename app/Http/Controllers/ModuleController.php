<?php

namespace App\Http\Controllers;

use App\Matiere;
use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function create()
    {
        return view('admin.module.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required', 
            'semestre' => 'required',
            'matieres' => 'nullable'
        ]);


        $module = Module::create([
            'module_name' => $request['module_name'], 
            'semestre' => $request['semestre']
        ]);

        if($request['matieres'])
            foreach($request['matieres'] as $matiere)
                Matiere::create([
                    'matiere_name' => $matiere, 
                    'module_id' => $module->id
                ]);
        
        $request->session()->flash('success', 'Module ' . $module->module_name . ' created succesfuly!');
        return redirect( route('users.index') );
    }
}
