<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;


class OrangSeeder extends Seeder
{
 public function run()
 {
  // $data = [
  //  [
  //   'nama' => 'Alex Gurning',
  //   'alamat'    => 'Jl. Merpati No.50 Medan',
  //   'created_at' => Time::now(),
  //   'updated_at' => Time::now()
  //  ],
  //  [
  //   'nama' => 'Budi Nugraha',
  //   'alamat'    => 'Jl. Gagak No.60 Medan',
  //   'created_at' => Time::now(),
  //   'updated_at' => Time::now()
  //  ],
  //  [
  //   'nama' => 'Citra Aulia',
  //   'alamat'    => 'Jl. Merak No.80 Medan',
  //   'created_at' => Time::now(),
  //   'updated_at' => Time::now()
  //  ]
  // ];

  // Simple Queries
  // $this->db->query("INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, ':created_at:', ':updated_at:')", $data);

  // use the factory to create a Faker\Generator instance

  // require_once 'vendor/autoload.php';
  $faker = \Faker\Factory::create('id_ID');

  for ($i = 0; $i < 100; $i++) {
   $data = [
    'nama' => $faker->name,
    'alamat'    => $faker->address,
    'created_at' => Time::createFromTimestamp($faker->unixTime()),
    'updated_at' => Time::createFromTimestamp($faker->unixTime())
   ];

   // Using Query Builder
   $this->db->table('orang')->insert($data);
  }

  //   $faker = Faker\Factory::create('fr_FR');
  // for ($i = 0; $i < 3; $i++) {
  //     echo $faker->name() . "\n";
  // }







  // $this->db->table('orang')->insertBatch($data);
 }
}
