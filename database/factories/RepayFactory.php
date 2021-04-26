<?php

namespace Database\Factories;

use App\Models\Repay;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Repay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'patient_id' => $this->faker->numberBetween(1, 100),
            'repay' => $this->faker->sentence(5, true),
            'created_at' => $this->faker->dateTimeBetween('2021-03-01', 'now', 'Asia/Shanghai')
        ];
    }
}
