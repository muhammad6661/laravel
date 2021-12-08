<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('tj_TJ');
        return [
            'category_id'=>random_int(6,8),
            'user_id'=>random_int(1,4),
            'title_ru'=>$faker->company,
            'is_active'=>true,
        ];
    }
}
