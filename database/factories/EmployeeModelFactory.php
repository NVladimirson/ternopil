<?php

namespace Database\Factories;

use App\Models\EmployeeModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $table->id();
        // $table->text('first_name');
        // $table->text('second_name');
        // $table->unsignedBigInteger('company_id');
        // $table->foreign('company_id')->references('id')->on('companies');
        // $table->text('email');
        // $table->text('phone');
        // $table->timestamps();

        return [
            'first_name' => $this->faker->firstName(),
            'second_name' => $this->faker->lastName(),
            'email' => $this->faker->email,
            'company_id' => rand(1,5) ? rand(1,10) : rand(11,100),
            'phone' => $this->faker->phoneNumber,
            'website' => (rand(0,1) ? 'http://www.' : 'https://www.').$this->faker->domainWord.'.'.$this->faker->tld,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
