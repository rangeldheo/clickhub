<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário associado
            'company_name' => $this->faker->company,
            'address' => $this->faker->address,
            'zipcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ];
    }
}
