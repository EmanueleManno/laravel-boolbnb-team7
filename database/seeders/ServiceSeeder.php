<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Services List
        $services = [
            // Essential
            ['name' => 'Wi-Fi', 'icon' => 'wifi'],
            ['name' => 'TV', 'icon' => 'tv'],
            ['name' => 'Lavatrice', 'icon' => 'soap'],
            ['name' => 'Asciugatrice', 'icon' => 'temperature-high'],
            ['name' => 'Ferro da stiro', 'icon' => 'shirt'],
            ['name' => 'Asciugacapelli', 'icon' => 'tornado'],
            ['name' => 'Cucina', 'icon' => 'kitchen-set'],
            ['name' => 'Aria Condizionata', 'icon' => 'temperature-arrow-down'],
            ['name' => 'Riscaldamento', 'icon' => 'temperature-arrow-up'],

            // Optional
            ['name' => 'Posto Macchina', 'icon' => 'car'],
            ['name' => 'Piscina', 'icon' => 'water-ladder'],
            ['name' => 'Portineria', 'icon' => 'bell-concierge'],
            ['name' => 'Sauna', 'icon' => 'house-tsunami'],
            ['name' => 'Vista Mare', 'icon' => 'water'],
        ];

        foreach ($services as $service) {

            $new_service = new Service();

            $new_service->name = $service['name'];
            $new_service->icon = $service['icon'];

            $new_service->save();
        }
    }
}
