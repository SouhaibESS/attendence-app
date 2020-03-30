<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Filiere;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ginf1Id = Filiere::select('id')->where('filiere', 'GINF1')->first();
        $ginf1Students = factory(Student::class, 10)->create(['filiere_id' => $ginf1Id]);

        $gsea1Id = Filiere::select('id')->where('filiere', 'GSEA1')->first();
        $gsea1Students[] = factory(Student::class, 10)->create(['filiere_id' => $gsea1Id]);

        $gstr1Id = Filiere::select('id')->where('filiere', 'GSTR1')->first();
        $gstr1Students[] = factory(Student::class, 10)->create(['filiere_id' => $gstr1Id]);

    }
}
