<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table = 'matieres';

    public $timestamps = false;

    protected $guarded = [];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function Module()
    {
        return $this->belongsTo(Module::class);
    }

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class);
    }
}
