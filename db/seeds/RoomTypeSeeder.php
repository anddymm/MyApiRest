<?php

use Phinx\Seed\AbstractSeed;

class RoomTypeSeeder extends AbstractSeed
{
    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [];

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

        $this->table('room_types')->insert($data)->saveData();
    }
}
