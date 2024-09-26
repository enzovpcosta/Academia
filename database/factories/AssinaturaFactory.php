<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assinatura>
 */
class AssinaturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plano' => 'Mensal',
            'ativo' => true,
            'obtencao' => date('Y-m-d'),
            'vencimento' => date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d')))),
            'user_id' => '17',
        ];
    }
}
