<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    public $timestamps = false;

    protected $table = 'filieres';

    protected $guarded = [];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function hasMatiere($matiere)
    {
        if($this->matieres()->where('id', $matiere->id)->first())
            return true;
        return false;
        
    }
}
