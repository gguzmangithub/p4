<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      $this->call(UsersTableSeeder::class);
      $this->call(AccesoriesTableSeeder::class);
      $this->call(TreatsTableSeeder::class);
      $this->call(OrdersTableSeeder::class);
      $this->call(AccesoryOrderTableSeeder::class);
      $this->call(OrderTreatTableSeeder::class);

      Model::reguard();
    }
}
