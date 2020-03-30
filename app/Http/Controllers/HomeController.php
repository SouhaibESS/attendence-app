<?php

namespace App\Http\Controllers;

use App\Filiere;
use App\Matiere;
use App\User;
use App\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;
use Symfony\Component\Console\Input\Input;
use DateTime;

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
        if(Gate::allows('isTeacher'))
        {
            $matieres = Auth()->user()->matieres;
            $matieres->load('filieres');

            return view('teacher.home', compact('matieres'));
        }
        return redirect(route('users.index'));
    }

    public function matiereShow(Matiere $matiere)
    { 
        //$filieres = $matiere->filieres;
        if(Gate::allows('teachesMatiere', [$matiere]))
        {
            $matiere->load('filieres');
            return view('teacher.show', compact('matiere'));
        }
        return redirect()->back();
    }

    public function filiereShow(Filiere $filiere, Matiere $matiere)
    {
        if(Gate::allows('teachesMatiere', [$matiere]) && Gate::allows('matiereBelongsToFiliere', [$filiere, $matiere]))
        {
            $filiere->load('students');
            return view('teacher.list', compact('filiere', 'matiere'));
        }
        return redirect()->back();
    }

    public function storeAbsence(Request $request, Filiere $filiere, Matiere $matiere)
    {
        $data = request()->validate([
            'timestamps' => 'required|in:1,2,3,4,5,6',
            'students.*' => 'nullable'
            ]);
        
        switch($request['timestamps'])
        {
            case 1 :
            { 
                $beginsAt = '09:00';
                $endsAt = '10:30';
                break;
            }
            case 2 :
            { 
                $beginsAt = '10:30';
                $endsAt = '12:15';
                break;
            }
            case 3 :
            { 
                $beginsAt = '13:30';
                $endsAt = '15:00';
                break;
            }
            case 4 :
            { 
                $beginsAt = '15:15';
                $endsAt = '16:45';
                break;
            }
            case 5 :
            { 
                $beginsAt = '09:00';
                $endsAt = '12:15';
                break;
            }
            case 6 :
            { 
                $beginsAt = '13:30';
                $endsAt = '16:45';
                break;
            }
        }
            
        $sessionData = [
            'session_date' => new DateTime(),
            'begins_at' => $beginsAt,
            'ends_at' => $endsAt,
            'matiere_id' => $matiere->id
        ];
        
        Absence::add($request['students'],$sessionData);
        $request->session()->flash('success', 'operation done!');
        return redirect()->back();
    }
}
