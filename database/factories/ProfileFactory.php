<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $users = User::all()->pluck('id')->toArray();
        // $department = Department::all()->pluck('id')->toArray();
        return [
            'address'       => $this->faker->address(),
            'phone_number'  => $this->faker->phoneNumber()
            // 'year'          => $this->faker->numberBetween(1, 4),
            // 'department_id' => $this->faker->randomElement($department),
        ];
    }
}
