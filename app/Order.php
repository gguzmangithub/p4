<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  # public function author() {
       # Order belongs to User
       # Define an inverse one-to-many relationship.
  #     return $this->belongsTo('\App\Author');
   #}

  public function user() {
     # Order belongs to User
     # Define an inverse one-to-many relationship.
         return $this->belongsTo('\App\User');
     }

  public function treat() {
     # Order belongs to Treat
     # Define an inverse one-to-many relationship.
   		 return $this->belongsToMany('\App\Treat')->withTimestamps();
   	}

    public function accesory() {
       # Order belongs to Accesory
       # Define an inverse one-to-many relationship.
     		 return $this->belongsToMany('\App\Accesory')->withTimestamps();
     	}

    }
