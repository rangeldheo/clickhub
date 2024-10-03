<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário associado
            'address' => $this->faker->address,
            'zipcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ];
    }
}
