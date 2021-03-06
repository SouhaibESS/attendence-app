<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereAny('name', $roles)->first())
            return true;
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
            return true;
        return false;
    }

    public static function teachers()
    {
        $teacherRole = Role::where('name', 'teacher')->first();

        return $teacherRole->users;        
    }

    public static function managers()
    {
        $managerRole = Role::where('name', 'manager')->first();

        return $managerRole->users;
    }

    public static function admins()
    {
        $adminRole = Role::where('name', 'admin')->first();

        return $adminRole->users;
    }

    public function hasMatiere($matiere)
    {
        if($this->matieres()->where('id', $matiere)->first())
            return true;
        return false;
        
    }
}
