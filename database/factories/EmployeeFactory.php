<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::all()->modelKeys();
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'company_id' => $this->faker->randomElement($companies),
            'email' => $this->faker->unique()->freeEmail(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
