<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notes::factory() -> create([
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ]);
    }
}
