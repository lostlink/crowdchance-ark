<?php

namespace Lostlink\LaravelBlockchain\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Lostlink\LaravelBlockchain\Models\Block;

class BlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Block::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data' => collect($this->faker->words(6))->toJson(),
            'nonce' => Carbon::now()->timestamp,
            'created_at' => Carbon::now(),
        ];
    }
}
