<?php

namespace Database\Factories;

use App\Models\Admin\Cattle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CattleFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente a la fábrica.
     *
     * @var string
     */
    protected $model = Cattle::class;

    /**
     * Define el estado por defecto del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $breeds = ['Brahman', 'Nelore', 'Angus', 'Holstein', 'Pardo Suizo', 'Simmental', 'Gyr'];
        $healthStatuses = ['Excelente', 'Bueno', 'En Tratamiento', 'Crítico'];
        $origins = ['verificado', 'no verificado'];

        // Coordenadas alrededor de Nicaragua (Managua, Estelí, Juigalpa)
        $lat = 12.1150 + (rand(-1000, 1000) / 10000);
        $lng = -86.2362 + (rand(-1000, 1000) / 10000);

        return [
            'arete' => 'FC-' . fake()->unique()->numberBetween(100000, 999999),
            'breed' => fake()->randomElement($breeds),
            'weight' => fake()->randomFloat(2, 350, 750), // Peso entre 350kg y 750kg
            'health_status' => fake()->randomElement($healthStatuses),
            'origin' => fake()->randomElement($origins),
            'latitude' => $lat,
            'longitude' => $lng,
        ];
    }
}
