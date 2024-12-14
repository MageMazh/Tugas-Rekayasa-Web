<?php

namespace Database\Factories;
use App\Models\Notes;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoteFactory extends Factory
{
    protected $model = Notes::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }

}
