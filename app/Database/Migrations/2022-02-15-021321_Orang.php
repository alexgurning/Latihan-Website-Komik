<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orang extends Migration
{
 public function up()
 {
  $this->forge->addField([
   'no'          => [
    'type'           => 'INT',
    'constraint'     => 11,
    'unsigned'       => true,
    'auto_increment' => true,
   ],
   'nama'       => [
    'type'       => 'VARCHAR',
    'constraint' => '255',
   ],
   'alamat' => [
    'type' => 'VARCHAR',
    'constraint' => '255',
   ],
   'created_at' => [
    'type'       => 'DATETIME',
    'null'       => true,
   ],
   'updated_at' => [
    'type'       => 'DATETIME',
    'null'       => true
   ]
  ]);
  $this->forge->addKey('no', true);
  $this->forge->createTable('orang');
 }

 public function down()
 {
  $this->forge->dropTable('orang');
 }
}
