<?php

use App\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement("SET foreign_key_checks=0");
        Specialty::truncate();
        DB::statement("SET foreign_key_checks=1");

        $specialties = [
            'ALERGOLOGIA',
            'ANGIOLOGIA',
            'BUCO MAXILO',
            'CARDIOLOGIA CLÍNICA',
            'CARDIOLOGIA INFANTIL',
            'CIRURGIA CABEÇA E PESCOÇO',
            'CIRURGIA CARDÍACA',
            'CIRURGIA DE CABEÇA/PESCOÇO',
            'CIRURGIA DE TÓRAX',
            'CIRURGIA GERAL',
            'CIRURGIA PEDIÁTRICA',
            'CIRURGIA PLÁSTICA',
            'CIRURGIA TORÁCICA',
            'CIRURGIA VASCULAR',
            'CLÍNICA MÉDICA'
        ];

        foreach ($specialties as $spec) {
            $specialty = new Specialty();
            $specialty->name = $spec;
            $specialty->save();
        }
    }
}
