<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = config('apartments');
        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();

            $new_apartment->title = $apartment['title'];
            $new_apartment->description = $apartment['description'];
            $new_apartment->price = $apartment['price'];
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->square_meters = $apartment['square_meters'];
            //$new_apartment->address = $apartment['address'];
            //$new_apartment->latitude = $apartment['latitude'];
            //$new_apartment->longitude = $apartment['longitude'];
            $new_apartment->image = $apartment['image'];
            $new_apartment->is_visible = $apartment['is_visible'];

            $new_apartment->save();
        }
    }
}