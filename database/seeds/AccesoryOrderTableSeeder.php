<?php

use Illuminate\Database\Seeder;

class AccesoryOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $orders =[
             'max' => ['bow','bowl','treatcontainer','blanket'],
             'cody' => ['bowl','treatcontainer'],
             'nala' => ['bowl','treatcontainer','blanket'],
             'diego' => ['bow','bowl','treatcontainer','blanket'],
         ];
           foreach($orders as $petname => $accesories) {

                    # First get the book
                    $order = \App\Order::where('pet_name','like',$petname)->first();
                    # Now loop through each accessory for this order, adding the pivot
                    foreach($accesories as $accesoryName) {
                        $accesory = \App\Accesory::where('name','LIKE',$accesoryName)->first();
                        # Connect this treat to this order - Creates the pivot
                        #$order->order_total = $orderPetname;
                        $order->accesory()->save($accesory);
                    }
            }
    }
}
