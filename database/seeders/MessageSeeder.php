<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Get related resource ids
        $apartments_ids = Apartment::pluck('id')->toArray();

        $message = new Message();

        $message->name = 'Titolo di prova';
        $message->content = 'Contenuto di prova';
        $message->email = 'Emaildiprova@gmail.com';
        $message->apartment_id = Arr::random($apartments_ids);

        $message->save();
    }
}
