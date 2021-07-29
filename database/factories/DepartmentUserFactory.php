<?php

namespace Database\Factories;

use App\Models\DepartmentUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DepartmentUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'department_id' => $this->faker->numberBetween(1, 16),
            'user_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
