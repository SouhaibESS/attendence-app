<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\User;
use App\Student;
use Gate;
use Illuminate\Http\Request;

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
            $teachers = User::teachers();
            return view('admin.index', compact('teachers'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

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
