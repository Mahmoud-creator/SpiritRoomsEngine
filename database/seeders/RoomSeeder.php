<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                "name" => "Room 1",
                "description" => "Room 1 description",
                "day" => "Mon",
                "avatar" => "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d51?s=200&d=mp",
            ],
            [
                "name" => "Room 2",
                "description" => "Room 2 description",
                "day" => "Tue",
                "avatar" => "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d52?s=200&d=mp",
            ],
            [
                "name" => "Room 3",
                "description" => "Room 3 description",
                "day" => "Wed",
                "avatar" => "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d53?s=200&d=mp",
            ],
            [
                "name" => "Room 4",
                "description" => "Room 4 description",
                "day" => "Thu",
                "avatar" => "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d54?s=200&d=mp",
            ],
            [
                "name" => "Room 5",
                "description" => "Room 5 description",
                "day" => "Fri",
                "avatar" => "https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d55?s=200&d=mp",
            ]
        ]);
    }
}
