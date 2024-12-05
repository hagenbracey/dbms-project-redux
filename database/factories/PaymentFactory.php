<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'cardholder' => $this->faker->name(),
            'card_number' => $this->faker->creditCardNumber(),
            'cvv' => $this->faker->numberBetween(100, 999),
            'expiration_date' => $this->faker->creditCardExpirationDateString(),
            'zip_code' => $this->faker->postcode(),
            'user_id' => User::factory(),
        ];
    }
}