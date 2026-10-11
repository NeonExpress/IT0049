<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAvatarToUsers extends Migration
{
    public function up(): void
    {
        if (! $this->db->tableExists('users') || $this->db->fieldExists('avatar', 'users')) {
            return;
        }

        $this->forge->addColumn('users', [
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }

    public function down(): void
    {
        if ($this->db->tableExists('users') && $this->db->fieldExists('avatar', 'users')) {
            $this->forge->dropColumn('users', 'avatar');
        }
    }
}
