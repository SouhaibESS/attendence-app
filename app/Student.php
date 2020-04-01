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

    public function totalAbsenceNumber()
    {
        $nmbr = DB::table('absences')
                    ->where('student_id', $this->id)
                    ->count();
        return $nmbr;
    }

    public function matiereAbsenceNumber()
    {
        $matieres = DB::table('matieres')
                        ->join('absences', 'matieres.id', '=', 'absences.matiere_id')
                        ->select('matieres.matiere_name', DB::raw('COUNT(absences.matiere_id) as nbrAbsencePerMatiere'))
                        ->where('student_id', $this->id)
                        ->groupBy('matieres.matiere_name')
                        ->orderBy('nbrAbsencePerMatiere', 'desc')
                        ->get();
        return $matieres;
    }

    public function unjustifiedAbsencesNumber()
    {
        $nmbr = Absence::where([
            'student_id' => $this->id,
            'justified' => 0
            ])->count();

        return $nmbr;
    }

    public function unjustifiedAbsences()
    {
        return Absence::where([
                            'student_id' => $this->id,
                            'justified' => 0
                        ])->get();
    }

    public function justifyAbsence($absences = null)
    {
        if($absences)
            foreach($absences as $absence)
                Absence::where('id', $absence)->update(['justified'=> 1]);
    }
}
