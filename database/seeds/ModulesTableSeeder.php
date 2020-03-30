<?php

use Illuminate\Database\Seeder;
use App\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'module_name' => 'C++',
            'semestre' => 'S2'
            ]);
        
        Module::create([
            'module_name' => 'WEB',
            'semestre' => 'S2'
            ]);

        Module::create([
            'module_name' => 'ECONOMY',
            'semestre' => 'S2'
            ]);
    }
}
