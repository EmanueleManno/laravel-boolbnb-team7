<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $message = new Message();

        $message->apartment_id = '1';
        $message->name = 'Titolo di prova';
        $message->content = 'Contenuto di prova';
        $message->email = 'Emaildiprova@gmail.com';

        $message->save();
    }
}
