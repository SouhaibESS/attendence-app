<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FiliereTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(MatieresTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
    }
}
