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
        
        $roomTypes = $this->fetchAll('SELECT id FROM room_types');
        $roomTypeIds = array_column($roomTypes, 'id');

        $data = [];

        $statuses = [
            RoomStatus::AVAILABLE->value,
            RoomStatus::MAINTENANCE->value,
            RoomStatus::OCCUPIED->value
        ];
        
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'room_type_id' => $faker->randomElement($roomTypeIds),
                'room_number'  => (string)(100 + $i),
                'status'       => $faker->randomElement($statuses),
            ];
        }

        $this->table('rooms')->insert($data)->saveData();
    }
}
