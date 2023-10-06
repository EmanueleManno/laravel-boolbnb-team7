<?php

namespace Database\Seeders;

use App\Models\Promotions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Promotions List
        $promotions = config('apartment_promotions');

        foreach ($promotions as $promotion) {

            $new_promotion = new Promotions();

            $new_promotion->name = $promotion['name'];
            $new_promotion->price = $promotion['price'];
            $new_promotion->duration = $promotion['duration'];

            $new_promotion->save();
        }
    }
}
