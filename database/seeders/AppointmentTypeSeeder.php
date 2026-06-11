<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppointmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointment_types')->insert([
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos@example.com',
                'service_type' => 'Desarrollo Web',
                'description' => 'Solicitud de cotización para una plataforma de comercio electrónico.',
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Laura Restrepo',
                'email' => 'laura@example.com',
                'service_type' => 'Mantenimiento de Software',
                'description' => 'Requiero soporte técnico para optimizar consultas en una base de datos MySQL.',
                'status' => 'completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Andrés Gómez',
                'email' => 'andres@example.com',
                'service_type' => 'Aplicación Móvil',
                'description' => 'Diseño de interfaz y backend para un sistema de agendamiento.',
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
