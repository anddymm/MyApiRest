<?php
use Phinx\Seed\AbstractSeed;
// Importamos el Enum del dominio de Rooms
use App\Rooms\Domain\RoomStatus;

class RoomSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return ['RoomTypeSeeder'];
    }

    public function run(): void
    {
        $faker = Faker\Factory::create();

        $roomTypes = $this->fetchAll('SELECT id, name FROM room_types');

        $imagesByType = [
            'Suite'      => [
                'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80',
                'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80',
                'https://images.unsplash.com/photo-1566195992011-5f6b21e539aa?w=800&q=80',
            ],
            'Doble'      => [
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800&q=80',
                'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&q=80',
                'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800&q=80',
            ],
            'Individual' => [
                'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?w=800&q=80',
                'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=800&q=80',
                'https://images.unsplash.com/photo-1484101403633-562f891dc89a?w=800&q=80',
            ],
            'Penthouse'  => [
                'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&q=80',
                'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=800&q=80',
                'https://images.unsplash.com/photo-1540518614846-7eded433c457?w=800&q=80',
            ],
            'Deluxe'     => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
                'https://images.unsplash.com/photo-1549294413-26f195200c16?w=800&q=80',
                'https://images.unsplash.com/photo-1561501900-3701fa6a0864?w=800&q=80',
            ],
        ];

        $typeMap = [];
        foreach ($roomTypes as $rt) {
            $typeMap[$rt['id']] = $rt['name'];
        }
        $roomTypeIds = array_keys($typeMap);

        $statuses = [
            RoomStatus::AVAILABLE->value,
            RoomStatus::MAINTENANCE->value,
            RoomStatus::OCCUPIED->value
        ];

        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $typeId   = $faker->randomElement($roomTypeIds);
            $typeName = $typeMap[$typeId];
            $images   = $imagesByType[$typeName] ?? ['https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80'];

            $data[] = [
                'room_type_id' => $typeId,
                'room_number'  => (string)(100 + $i),
                'status'       => $faker->randomElement($statuses),
                'image_url'    => $faker->randomElement($images),
            ];
        }

        $this->table('rooms')->insert($data)->saveData();
    }
}
