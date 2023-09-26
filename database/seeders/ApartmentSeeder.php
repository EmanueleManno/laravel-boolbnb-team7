<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get related resource ids
        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();
        $service_ids = Service::pluck('id')->toArray();

        $apartments = config('apartments');
        foreach ($apartments as $apartment) {
            $new_apartment = new Apartment();

            $new_apartment->title = $apartment['title'];
            $new_apartment->user_id = Arr::random($user_ids);
            $new_apartment->category_id = Arr::random($category_ids);
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


            // Generate random services
            $apartment_services = [];
            foreach ($service_ids as $service_id) {
                if (rand(0, 1)) $apartment_services[] = $service_id;
            }

            $new_apartment->services()->attach($apartment_services);
        }
    }
}
