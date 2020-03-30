<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    public $timestamps = false;

    protected $guarded = [];
    
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }
}
