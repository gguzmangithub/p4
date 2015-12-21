<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $datapetname = ['max','cody','nala','diego'];
      for($i=0; $i < count($datapetname); ++$i) {
          $order = new \App\Order();
          $order->pet_name = $datapetname[$i];
          $order->user_id = 1;
          $order->save();
      }

    }
}
