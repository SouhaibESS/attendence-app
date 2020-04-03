<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Role;
use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function find(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'cne' => 'required'
        ]);

        $student = Student::where(['cne' => $request->cne, 'name' => $request->name])->first();
        if($student)
            return redirect( route('student.show', $student) );
            
        $request->session()->flash('studentNotFound', 'Student Not Found!');
        return redirect()->back();
    }

    public function show(Student $student)
    {
        $student->load('absences.matiere');
        return view('student.show', compact('student'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('admin.student.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'cne' => 'required|unique:students',
                'filiere_id' => 'required'
        ]);

        
        $student = Student::create([
            'cne' => $request['cne'],
            'name' => $request['name'], 
            'filiere_id' => $request['filiere_id']
            ]);
            
        $request->session()->flash('success', 'Student ' . $request['name'] . ' added succesfuly!');
        return redirect(route('users.index'));

    }

    public function edit(Student $student)
    {
        $filieres = Filiere::all();
        return view('admin.student.edit', compact('student', 'filieres'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'cne' => 'required|unique:students', 
            'filiere_id' => 'required'
            ]);

        $student->update([
            'cne' => $request['cne'],
            'name' => $request['name'], 
            'filiere_id' => $request['filiere_id']
            ]);
            
        $request->session()->flash('success', 'Student ' . $request['name'] . ' updated succesfuly!');
        return redirect(route('filieres.show', $student->filiere_id));
    }

    public function destroy(Student $student)
    {
        $filiere = $student->filiere_id;

        request()->session()->flash('userDeleted','Student ' . $student->name . ' deleted!');
        $student->delete();

        return redirect(route('filieres.show', $filiere));
    }
}
