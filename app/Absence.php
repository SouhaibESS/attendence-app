<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absences';
    
    public $timestamps = false;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public static function add($studentsData = null, $sessionData)
    {
        if($studentsData)
        {
            foreach($studentsData as $student)
            {
                Absence::create([
                    'session_date' => $sessionData['session_date'],
                    'begins_at' => $sessionData['begins_at'],
                    'ends_at' => $sessionData['ends_at'],
                    'matiere_id' => $sessionData['matiere_id'],
                    'student_id' => $student
                ]);
            }
        }
    }
}
