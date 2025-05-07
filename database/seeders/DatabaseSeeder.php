<?php

namespace Database\Seeders;

use AnourValar\EloquentSerialize\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('senha'),
        ]);

        $services = [
            ['label' => 'oil_change', 'name' => 'Troca de óleo do motor e filtro de óleo'],
            ['label' => 'air_filter', 'name' => 'Verificação e possível troca do filtro de ar'],
            ['label' => 'fluid_check', 'name' => 'Verificação do fluido de freio e arrefecimento'],
            ['label' => 'brake_check', 'name' => 'Verificação dos freios (pastilhas)'],
            ['label' => 'alignment', 'name' => 'Alinhamento e balanceamento'],
            ['label' => 'fuel_filter', 'name' => 'Troca do filtro de combustível'],
            ['label' => 'engine_air_filter', 'name' => 'Troca do filtro de ar do motor'],
            ['label' => 'suspension_check', 'name' => 'Verificação mais detalhada da suspensão'],
            ['label' => 'battery_check', 'name' => 'Revisão da bateria e sistema elétrico'],
            ['label' => 'cabin_filter', 'name' => 'Troca do filtro do ar-condicionado (ou filtro de cabine)'],
            ['label' => 'cooling_clean', 'name' => 'Limpeza do sistema de arrefecimento'],
            ['label' => 'spark_check', 'name' => 'Verificação das velas de ignição'],
            ['label' => 'injector_check', 'name' => 'Inspeção dos bicos injetores'],
            ['label' => 'brake_fluid', 'name' => 'Troca do fluido de freio'],
            ['label' => 'steering_fluid', 'name' => 'Troca do fluido da direção hidráulica'],
            ['label' => 'belt_check', 'name' => 'Verificação da correia dentada'],
            ['label' => 'bolt_torque', 'name' => 'Reaperto geral de parafusos da suspensão e motor'],
            ['label' => 'belt_replace', 'name' => 'Troca da correia dentada'],
            ['label' => 'spark_replace', 'name' => 'Troca das velas de ignição'],
            ['label' => 'suspension_full', 'name' => 'Revisão completa da suspensão'],
            ['label' => 'catalyst_check', 'name' => 'Verificação do catalisador'],
            ['label' => 'trans_fluid', 'name' => 'Troca do fluido do câmbio'],
            ['label' => 'water_pump', 'name' => 'Troca da bomba d’água'],
            ['label' => 'wheel_bearing', 'name' => 'Verificação dos rolamentos das rodas'],
            ['label' => 'exhaust_check', 'name' => 'Avaliação do sistema de escapamento'],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['label' => $service['label']], $service);
        }

    }
}
