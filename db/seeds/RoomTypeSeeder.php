<?php

use Phinx\Seed\AbstractSeed;

class RoomTypeSeeder extends AbstractSeed
{
    public function run(): void
    {
        // Inicializamos Faker
        $faker = Faker\Factory::create();
        $data = [];

        // Generamos 5 tipos de habitaciones falsas
        $types = ['Suite', 'Doble', 'Individual', 'Penthouse', 'Deluxe'];

        foreach ($types as $type) {
            $data[] = [
                'name'        => $type,
                'description' => $faker->sentence(10),
                'base_price'  => $faker->randomFloat(2, 50, 500),
                'capacity'    => $faker->numberBetween(1, 4),
                'created_at'  => date('Y-m-d H:i:s'),
            ];
        }

        // Insertamos en la tabla que creaste con la migración
        $this->table('room_types')->insert($data)->saveData();
    }
}
