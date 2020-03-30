<?php

use Illuminate\Database\Seeder;
use App\Module;
use App\Matiere;
use App\User;

class MatieresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cpp = Module::where('module_name','C++')->first();
        $eco = Module::where('module_name', 'ECONOMY')->first();
        $web = Module::where('module_name', 'WEB')->first();

        $cpp->matieres()->create([
            'matiere_name' => 'OOP in C++'
        ]);

        $economy = [
            ['matiere_name' => 'MARKETING'] ,
            ['matiere_name' => 'GESTION'] ,
            ['matiere_name' => 'COMPTABILITY']
        ];
        $eco->matieres()->createMany($economy);

        $wb = [
            ['matiere_name' => 'PHP'],
            ['matiere_name' => 'SQL']
        ];
        $web->matieres()->createMany($wb);

        $teachers = User::teachers();

        $teachers[0]->matieres()->attach(1);

        $teachers[1]->matieres()->attach(2);
        $teachers[2]->matieres()->attach(3);
        $teachers[3]->matieres()->attach(4);

        $teachers[4]->matieres()->attach([5,6]);
    }
}
