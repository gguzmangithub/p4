<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treat extends Model
{
  public function orders() {
#Treat has many to many rel with orders
#Define a m:m relationship
  #return $this->belongsToMany('\App\Order', 'order_treat', 'order_id', 'treat_id')->withPivot('quantity', 'extended_price');
    return $this->belongsToMany('\App\Order')->withTimestamps();
  }

  public function getTreatsForCheckboxes() {

        $treats = $this->orderBy('name','ASC')->get();

        $treatsForCheckboxes = [];

        foreach($treats as $treat) {
            $treatsForCheckboxes[$treat['id']] = $treat->name;
                    }

        return $treatsForCheckboxes;
    }

    public function getTreatsForInputboxes() {

          $treatquantities = $this->orderBy('name','ASC')->get();

          $treatsForInputboxes = [];

          foreach($treatquantities as $treatquantity) {
              $treatsForInputboxes[$treatquantity['id']] = $treatquantity->quantity;
                      }

          return $treatsForInputboxes;
      }

      public function getTreatsPrices() {

            $treatprices = $this->orderBy('name','ASC')->get();

            $treatsForPrices = [];

            foreach($treatprices as $treatprice) {
                $treatsForPrices[$treatprice['id']] = $treatprice->price;
                        }

            return $treatsForPrices;
        }

}



#public function books() {
#      return $this->belongsToMany('\App\Book')->withTimestamps();
#  }
