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
            'name' => $this->faker->name,
            'phone' => $this->faker->PhoneNumber,
            'user_id' => $this->faker->randomElement([0, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'platform_id' => $this->faker->randomElement([1, 2, 3, 4]),
            'origin_id' => $this->faker->randomElement([1, 2, 3]),
            'project_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'is_appointment' => $this->faker->randomElement([true, false]),
            'is_add_wechat' => $this->faker->randomElement([true, false]),
            'is_to_store' => $this->faker->randomElement([true, false]),
            'is_introduce_intention' => $this->faker->randomElement([true, false]),
            'is_introduce' => $this->faker->randomElement([true, false]),
            'created_at' => $this->faker->dateTimeBetween('2021-04-26', 'now', 'Asia/Shanghai')
        ];
    }
}
