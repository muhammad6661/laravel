<?php

namespace Database\Factories;

use App\Models\Shareholder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShareholderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shareholder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ru_Ru');
        return [
            'organization_id'=>random_int(3,500),
            'fio_ru'=>$faker->firstName.' '.$faker->lastName,
            'is_active'=>true,
            'stock'=>random_int(1,100),
            'plz'=>random_int(0,1),
            'birthday'=>$faker->date('Y-m-d H:m:s'),
            'country_id'=>random_int(1,250),
        ];
    }
}
