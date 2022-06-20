<?php

use App\Utilisateur;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Utilisateur::create([
            "nom" => "Admin",
            "login" => "admin",
            "password" => sha1('admin'),
            "type" => "admin"
        ]);
    }
}
