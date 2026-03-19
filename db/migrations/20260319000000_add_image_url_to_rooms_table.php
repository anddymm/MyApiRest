<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddImageUrlToRoomsTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('rooms')
            ->addColumn('image_url', 'string', ['limit' => 500, 'null' => true, 'default' => null])
            ->update();
    }
}