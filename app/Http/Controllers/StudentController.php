<?php

namespace App\Http\Controllers;

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
}
