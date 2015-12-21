<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesory extends Model
{
  public function orders() {
#Treat has many to many rel with orders
#Define a m:m relationship
  #    return $this->belongsToMany('\App\Order', 'accesory_order', 'order_id', 'accesory_id')->withPivot('quantity', 'extended_price');
  return $this->belongsToMany('\App\Order')->withTimestamps();
  }  //
  public function getAccesoriesForCheckboxes() {

        $accesories = $this->orderBy('name','ASC')->get();

        $accesoriesForCheckboxes = [];

        foreach($accesories as $accesory) {
            $accesoriesForCheckboxes[$accesory['id']] = $accesory->name;
        }

        return $accesoriesForCheckboxes;
    }

    public function getAccesoriesForInputboxes() {

          $accesoryquantities = $this->orderBy('name','ASC')->get();

          $accesoriessForInputboxes = [];

          foreach($accesoryquantities as $accesoryquantity) {
              $accesoriesForInputboxes[$accesoryquantity['id']] = $accesoryquantity->quantity;
                      }

          return $accesoriesForInputboxes;
      }

      public function getAccesoriesPrices() {

            $accesoryprices = $this->orderBy('name','ASC')->get();

            $accesoriesForPrices = [];

            foreach($accesoryprices as $accesoryprice) {
                $accesoriesForPrices[$accesoryprice['id']] = $accesoryprice->price;
                        }

            return $accesoriesForPrices;
        }
}
