<?php

namespace Database\Factories;

use App\Models\Bin;
use Illuminate\Database\Eloquent\Factories\Factory;

class BinFactory extends Factory
{
    /**  
     * The name of the factory's corresponding model.  
     *  
     * @var string  
     */  
    protected $model = Bin::class;

    /**  
     * Define the model's default state.  
     *  
     * @return array  
     */  
    public function definition()
    {
        // Contoh area Jakarta kecil untuk lat/lng
        $lat = $this->faker->latitude($min = -6.3000, $max = -6.2000);
        $lng = $this->faker->longitude($min = 106.7000, $max = 106.9000);

        return [
            'weight'    => $this->faker->randomFloat(1, 0, 20),     // 0.0 – 20.0 kg
            'latitude'  => $lat,
            'longitude' => $lng,
            'distance'  => $this->faker->numberBetween(50, 2000),   // 50 – 2000 m
        ];
    }
}
