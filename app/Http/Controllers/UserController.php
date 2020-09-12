<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Matiere;
use App\Module;
use App\Role;
use App\User;
use App\Student;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('isAdmin'))
        {
            $teachers = User::teachers()->count();
            $managers = User::managers()->count();
            $admins = User::admins()->count();
            $filieres = Filiere::count();
            $modules = Module::count();

            return view('admin.index', compact('teachers', 'managers', 'admins', 'filieres', 'modules'));
        }
        return redirect()->back();
    }

    public function teachers()
    {
        $teachers = User::teachers();

        return view('admin.teachers', compact('teachers'));
    }

    public function managers()
    {
        $managers = User::managers();

        return view('admin.managers', compact('managers'));
    }

    public function modules()
    {
        $modules = Module::all();
        $modules->load('matieres');

        return view('admin.modules', compact('modules'));
    }

    public function filieres()
    {
        $filieres = Filiere::all();

        return view('admin.filieres', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('isAdmin'))
        {
            $roles = Role::all();
            return view('admin.create', compact('roles'));
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation());
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->roles()->attach($request['role']);
        
        $request->session()->flash('success', 'user added succesfuly!');
        return redirect(route('users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::allows('isAdmin'))
        {
            $matieres = Matiere::all();
            return view('admin.edit', compact('user', 'matieres'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'matieres' => 'nullable'
        ]);

        $user->update([
            'name' => $request['name']
        ]);

        $user->matieres()->attach($request['matieres']);
        
        $request->session()->flash('success', 'teacher ' . $user->name . ' updated');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        request()->session()->flash('userDeleted', 'user deleted');
        return redirect(route('users.index'));
    }

    public function validation()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required'
        ];
    }


    // MANAGER METHODS
    public function managerIndex()
    {
        $filieres = Filiere::all();
        
        return view('manager.index', compact('filieres'));
    }

    public function mShowFiliere(Filiere $filiere)
    {
        $filiere->load('students');
        
        return view('manager.showFiliere', compact('filiere'));
    }
    
    public function mShowstudent(Student $student)
    {
        $student->load('absences.matiere');
        $student->load('filiere');

        return view('manager.showStudent', compact('student'));        
    }

    public function mJustifyAbsence(Request $request, Student $student)
    {
        $student->justifyAbsence($request['absences']);

        $request->session()->flash('success', 'operation done succesfuly!');
        return redirect()->back();
    }

}
