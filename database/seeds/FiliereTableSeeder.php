<?php

use Illuminate\Database\Seeder;
use App\Filiere;
use App\Matiere;

class FiliereTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matieres = Matiere::all();
        $ecoMatieres = Matiere::where('module_id', 3)->get();

        $ginf1 = Filiere::create(['filiere' => 'GINF1']);
        $gsea1 = Filiere::create(['filiere' => 'GSEA1']);
        $gstr1 = Filiere::create(['filiere' => 'GSTR1']);

        $inf1 = Filiere::where('id', $ginf1->id)->first();
        $sea1 = Filiere::where('id', $gsea1->id)->first();
        $str1 = Filiere::where('id', $gstr1->id)->first();

        $inf1->matieres()->attach($matieres);
        $sea1->matieres()->attach($ecoMatieres);
        $str1->matieres()->attach($ecoMatieres);
    }
}
