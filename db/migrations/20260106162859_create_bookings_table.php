<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateBookingsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('bookings');
        $table->addColumn('room_id', 'integer', ['signed' => false])
            ->addColumn('guest_name', 'string', ['limit' => 100])
            ->addColumn('check_in', 'date')
            ->addColumn('check_out', 'date')
            ->addColumn('total_price', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('status', 'enum', ['values' => ['pending', 'confirmed', 'cancelled']])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('room_id', 'rooms', 'id', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->create();
    }
}
