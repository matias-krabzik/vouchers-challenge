<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentFile>
 */
class PaymentFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::first();
        return [
            "user_id" => $user->id,
            "organization_id" => 1,
            "payment_file_status_id" => 1,
            "company_id" => 1,
            "cycle_start" => $this->faker->date,
            "cycle_end" => $this->faker->date,
            "account" => $this->faker->name
        ];
    }
}
