<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{

    protected $table = 'students';

    public $timestamps = false;

    protected $fillable = ['cne', 'filiere'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function totalAbsenceNumbre()
    {
        $nmbr = DB::table('absences')
                    ->where('student_id', $this->id)
                    ->count();
        return $nmbr;
    }

    public function matiereAbsenceNumbre()
    {
        $matieres = DB::table('matieres')
                        ->join('absences', 'id', '=', 'absences.matiere_id')
                        ->select('matieres.matiere_name', DB::raw('COUNT(absences.matiere_id) as nbrAbsencePerMatiere'))
                        ->where('student_id', $this->id)
                        ->groupBy('matieres.matiere_name')
                        ->orderBy('nbrAbsencePerMatiere', 'desc')
                        ->get();
        return $matieres;
    }
}
