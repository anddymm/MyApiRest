<?php
namespace App\Rooms\Infrastructure\Persistence;

use App\Rooms\Domain\RoomRepository;
use PDO;

class PdoRoomRepository implements RoomRepository {
    public function __construct(private PDO $connection) {}

    public function findAll(): array {
        $sql = "SELECT r.id, r.room_number, r.status, rt.name as type_name, rt.base_price 
                FROM rooms r 
                JOIN room_types rt ON r.room_type_id = rt.id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function update(int $id, array $data): bool {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");

        $sql = "UPDATE rooms SET $fields WHERE id = :id";
        $data['id'] = $id;

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }
}