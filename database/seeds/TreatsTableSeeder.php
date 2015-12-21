<?php

use Illuminate\Database\Seeder;

class TreatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dataname = ['meatlover','veggie','original','sweetlover'];
      $dataflavor = ['meat','vegetables','sugar','syrup'];
      $datasize = ['small','medium','large','large'];
      $datadescription = ['Delicious organic beef treats',
                          'Delicious carrots and beans treats',
                          'Delicious treats made of organic sugar',
                          'Delicious treats made of organic mapple syrup'];
      $dataprice = ['10.00','7.00','5.99','4.99'];
      $dataquantity = ['1','2','3','4'];
      for($i=0; $i < count($dataname); ++$i) {
          $treat = new \App\Treat();
          $treat->name = $dataname[$i];
          $treat->flavor = $dataflavor[$i];
          $treat->size = $datasize[$i];
          $treat->price = $dataprice[$i];
          $treat->quantity = $dataquantity[$i];
          $treat->order_total = $dataquantity[$i] * $dataprice[$i];
          $treat->description = $datadescription[$i];
          $treat->save();
      }

  }
}
