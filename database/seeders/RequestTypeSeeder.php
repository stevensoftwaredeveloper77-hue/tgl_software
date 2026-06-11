<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('request_types')->insert([
            [
                'id' => 1,
                'name' => 'Desarrollo web',
                'description' => 'Sitios web, aplicaciones y sistemas a medida.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Reporte de Error',
                'description' => 'Notificar bugs o problemas en proyectos existentes...',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Nuevo Proyecto',
                'description' => 'Iniciar un proyecto desde cero',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Soporte Técnico',
                'description' => 'Asistencia con sistemas o aplicaciones.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Consultoría',
                'description' => 'Asesoramiento técnico y estratégico.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'Integraciones',
                'description' => 'APIs, bases de datos y servicios externos.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
