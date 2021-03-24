<?php

namespace Database\Factories;
use App\Models\CompanyModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // $table->id();
        // $table->text('title');
        // $table->text('email');
        // $table->text('logo');
        // $table->timestamps();

        return [
            'title' => $this->faker->company,
            'email' => $this->faker->email,
            'logo' => 'default.png',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
