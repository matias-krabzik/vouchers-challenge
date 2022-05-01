<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "last_name" => $this->faker->lastName,
            "age" => $this->faker->numberBetween(18,68),
            "residence_country_id" => 1,
            "number" => 1,
            "booking_status_id" => 1,
            "pickup_office_id" => 2,
            "dropoff_office_id" => 1,
            "pickup_country_id" => 1,
            "dropoff_country_id" => 1,
            "company_id" => 1,
        ];
    }
}
