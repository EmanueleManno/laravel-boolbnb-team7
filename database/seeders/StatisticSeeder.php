<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get related resource ids
        $apartments_ids = Apartment::pluck('id')->toArray();

        $statistics = config('apartment_statistics');
        foreach ($statistics as $statistic) {

            $new_statistic = new Statistic();

            $new_statistic->ip_address = $statistic['ip_address'];
            $new_statistic->date = $statistic['date'];
            $new_statistic->apartment_id = Arr::random($apartments_ids);

            $new_statistic->save();
        }
    }
}
