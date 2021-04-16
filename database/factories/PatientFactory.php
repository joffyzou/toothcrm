<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->id,
            'name' => $this->faker->name,
            'platform' => $this->faker->randomElement(['大众', '表单', 3]),
            'phone' => $this->faker->PhoneNumber,
            'admin_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'is_appointment' => $this->faker->randomElement([0, 1]),
            'is_add_wechat' => $this->faker->randomElement([0, 1]),
            'project' => $this->faker->randomElement([0, 1]),
            'is_to_store' => $this->faker->randomElement([0, 1]),
            'achievement' => $this->faker->numberBetween($min = 1000, $max = 9000)
        ];
    }
}
