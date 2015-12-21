<?php

use Illuminate\Database\Seeder;

class OrderTreatTableSeeder extends Seeder
{
  /**
     * @return void
     */
    public function run()
    {

      $orders =[
             'max' => ['original','meatlover'],
             'cody' => ['meatlover','veggie','original','sweetlover'],
             'nala' => ['meatlover'],
             'diego' => ['meatlover','veggie','original','sweetlover'],
         ];
           foreach($orders as $petname => $treats) {

                    # First get the book
                    $order = \App\Order::where('pet_name','like',$petname)->first();
                                       # Now loop through each tag for this book, adding the pivot
                    foreach($treats as $treatName) {
                        $treat = \App\Treat::where('name','LIKE',$treatName)->first();
                        # Connect this treat to this order - Creates the pivot
                        #$order->order_total = $orderPetname;
                        $order->treat()->save($treat);
                    }

                }
    }
}
