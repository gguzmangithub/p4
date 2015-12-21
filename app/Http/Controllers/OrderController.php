<?php

namespace App\Http\Controllers;

/* use Illuminate\Http\Request; */

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrderController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getIndex(Request $request) {
         // Get all the orders created by the current logged in users
         // Sort in descending order by id
         $orders = \App\Order::where('user_id','=',\Auth::id())->orderBy('id','DESC')->get();

         return view('orders.index')->with('orders',$orders);
     }
     /**
     * Responds to requests to GET /books/edit/{$id}
     */
     public function getEdit($id = null) {

         # Get this book and eager load its tags
         /* $ordertreat = \App\Order::with('treat')->find($id);
         $orderaccesory = \App\Order::with('accesory')->find($id); */
         /* $order = \App\Order::where('user_id','=',\Auth::id())->orderBy('id','DESC')->get(); */

         $order = \App\Order::with('accesory')->find($id);

         if(is_null($order)) {
             \Session::flash('flash_message','We are sorry, but your order was not found.');
             return redirect('\orders');
         }

         # Get all the possible accessories to display to the user
        $accesoryModel = new \App\Accesory();
        $accesories_for_checkbox = $accesoryModel->getAccesoriesForCheckboxes();
        $accesories_for_inputbox = $accesoryModel->getAccesoriesForInputboxes();
        $accesoryprices_for_display = $accesoryModel->getAccesoriesPrices();

        # Get all the possible treats to display to the user
        $treatModel = new \App\Treat();
        $treats_for_checkbox = $treatModel->getTreatsForCheckboxes();
        $treats_for_inputbox = $treatModel->getTreatsForInputboxes();
        $treatprices_for_display = $treatModel->getTreatsPrices();
        /*
        Create a simple array of just the tag names for tags associated with this book;
        will be used in the view to decide which tags should be checked off
        */
      /*  $accesories_for_this_order = [];
        $accesoryquantities_for_this_order = [];
        $accesoryprices_for_this_order = [];
        $accesory =new \App\Accesory();
        for($i=0; $i < count($accesories_for_checkbox); ++$i) {
          $accesories_for_this_order[$i]=$accesory->name;
          $accesoryquantities_for_this_order[$i]=$accesory->quantity;
          $accesoryprices_for_this_order[$i]=$accesory->price;
        } */
        $accesories_for_this_order = [];
        $accesoryquantities_for_this_order = [];
        $accesoryprices_for_this_order = [];
        foreach($order->accesory as $accesory) {
            $accesories_for_this_order[] = $accesory->name;
            $accesoryquantities_for_this_order[] = $accesory->quantity;
            $accesoryprices_for_this_order[] = $accesory->price;
        }

        $treats_for_this_order= [];
        $treatquantities_for_this_order = [];
        $treatprices_for_this_order = [];

        foreach($order->treat as $treat) {
            $treats_for_this_order[] = $treat->name;
            $treatquantities_for_this_order[] = $treat->quantity;
            $treatprices_for_this_order[] = $treat->price;
        }
        /* for($i=0; $i < count($dataname); ++$i) {
            $accesory = new \App\Accesory();
            $accesory->name = $dataname[$i];
            $accesory->size = $datasize[$i];
            $accesory->price = $dataprice[$i];
            $accesory->quantity = $dataquantity[$i];
            $accesory->order_total = $dataquantity[$i] * $dataprice[$i];
            $accesory->description = $datadescription[$i];
           $accesory->save(); */

/*
        $treats_for_this_order = [];
        $treatquantities_for_this_order = [];
        $treatprices_for_this_order = [];
        foreach($ordertreat->treats as $treat) {
            $treats_for_this_order[] = $treat->name;
            $treatquantities_for_this_order[] = $treat->quantity;
            $treatprices_for_this_order[] = $treat->price;
        }
*/
/*$treats_for_this_order = [];
$treatquantities_for_this_order = [];
$treatprices_for_this_order = [];
$treat =new \App\Treat();
for($i=0; $i < count($treats_for_checkbox); ++$i) {
  $treats_for_this_order[$i]=$treat->name;
  $treatquantities_for_this_order[$i]=$treat->quantity;
  $treatprices_for_this_order[$i]=$treat->price;
} */


        return view('orders.edit')
            ->with([
            /*    'ordertreat' => $ordertreat,
                'orderaccesory' => $orderaccesory, */
                'order' => $order,
                'accesories_for_checkbox' => $accesories_for_checkbox,
                'accesories_for_inputbox'=> $accesories_for_inputbox,
                'accesoryprices_for_display' => $accesoryprices_for_display,
                'accesories_for_this_order' => $accesories_for_this_order,
                'accesoryquantities_for_this_order' => $accesoryquantities_for_this_order,
                'accesoryprices_for_this_order' => $accesoryprices_for_this_order,
                'treats_for_checkbox' => $treats_for_checkbox,
                'treats_for_inputbox' => $treats_for_inputbox,
                'treats_for_display' => $accesoryprices_for_display,
                'treats_for_this_order' => $treats_for_this_order,
                'treatquantities_for_this_order' => $treatquantities_for_this_order,
                'treatprices_for_this_order' => $treatprices_for_this_order,
            ]);
      }
      /**
          * Responds to requests to POST /orders/edit
          */
    public function postEdit(Request $request) {
                $order = \App\Order::find($request->id);

                $order->pet_name = $request->pet_name;
                /* $order->quantity = $request->quantity; */

                $order->save();

                if($request->accesories) {
                    $accesories = $request->accesories;
                }
                else {
                    $accesories = [];
                }
                $order->accesory()->sync($accesories);

                if($request->treats) {
                    $treats = $request->treats;
                }
                else {
                    $treats = [];
                }
                $order->treat()->sync($treats);

                \Session::flash('flash_message','Your order was updated.');
                return redirect('/orders/edit/'.$request->id);
            }

            /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {

      # Get all the possible accessories to display to the user
     $accesoryModel = new \App\Accesory();
     $accesories_for_checkbox = $accesoryModel->getAccesoriesForCheckboxes();
     $accesories_for_inputbox = $accesoryModel->getAccesoriesForInputboxes();
     $accesoryprices_for_display = $accesoryModel->getAccesoriesPrices();

     # Get all the possible treats to display to the user
     $treatModel = new \App\Treat();
     $treats_for_checkbox = $treatModel->getTreatsForCheckboxes();
     $treats_for_inputbox = $treatModel->getTreatsForInputboxes();
     $treatprices_for_display = $treatModel->getTreatsPrices();

        return view('orders.create')
            ->with('treats_for_checkbox',$treats_for_checkbox)
            ->with('treats_for_inputbox',$treats_for_inputbox)
            ->with('accesories_for_checkbox',$accesories_for_checkbox)
            ->with('accesories_for_inputbox',$accesories_for_inputbox)
            ->with('accesoryprices_for_display',$accesoryprices_for_display)
            ->with('treatprices_for_display',$treatprices_for_display);
    }
    /**
     * Responds to requests to POST /orders/create
     */
    public function postCreate(Request $request) {
        $this->validate(
            $request,
            [
                'pet_name' => 'required|min:2',
                'treats' => 'required_without:accesories',
                'accesories' => 'required_without:treats',
            ]
        );
              # Enter order into the database
        $order = new \App\Order();
        $order->pet_name = $request->pet_name;
        #$book->author_id = $request->author;
        $order->user_id = \Auth::id(); # <--- NEW LINE
        #$order->quantity = $request->quantity;
        $order->save();
        # Add the accessories
        if($request->accesories) {
            $accesories = $request->accesories;
        }
        else {
            $accesories = [];
        }
        $order->accesory()->sync($accesories);
        #$ordertreat = new \App\Order();
        #$ordertreat->pet_name = $request->pet_name;
        #$book->author_id = $request->author;
        #$ordertreat->user_id = \Auth::id(); # <--- NEW LINE
        #$order->quantity = $request->quantity;
        #$ordertreat->save();
        # Add the treats
        if($request->treats) {
            $treats = $request->treats;
        }
        else {
            $treats = [];
        }
        $order->treat()->sync($treats);
        # Done
        \Session::flash('flash_message','Your order was added!');
        return redirect('/orders');
    }
    /**
     * Responds to requests to GET /orders/show/
     */
    public function getShow($petname = null, $createdat = null) {
        return view('orders.show')->with('pet_name',$petname)
                                  ->with('created_at',$createdat);
    }
    /**
	*
	*/
    public function getConfirmDelete($order_id) {
        $order = \App\Order::find($order_id);
        return view('orders.delete')->with('order', $order);
    }
    /**
	*
	*/
    public function getDoDelete($order_id) {

        $order = \App\Order::find($order_id);

        if(is_null($order)) {
            \Session::flash('flash_message','I am sorry but your order was not found.');
            return redirect('/orders');
        }

        if($order->treat()) {
            $order->treat()->detach();
        }

        if($order->accesory()) {
          $order->accesory()->detach();
        }

        $order->delete();

        \Session::flash('flash_message','Your order for '.$order->pet_name.' created on '.$order->created_at.' was deleted.');

        return redirect('/orders');
    }
}
