<?php

use Illuminate\Database\Seeder;

class AccesoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dataname = ['bow','bowl','treatcontainer','blanket'];
      $datasize = ['small','medium','large','xlarge'];
      $datadescription = ['Beautiful black bows',
                          'Metallic bowl',
                          'Fillable treat container',
                          'Snuggly blanket'];
      $dataprice = ['10.00','7.00','5.99','4.99'];
      $dataquantity = ['1','2','3','4'];
      for($i=0; $i < count($dataname); ++$i) {
          $accesory = new \App\Accesory();
          $accesory->name = $dataname[$i];
          $accesory->size = $datasize[$i];
          $accesory->price = $dataprice[$i];
          $accesory->quantity = $dataquantity[$i];
          $accesory->order_total = $dataquantity[$i] * $dataprice[$i];
          $accesory->description = $datadescription[$i];
         $accesory->save();
       }
     }
   }
