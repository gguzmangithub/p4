@extends('layouts.master')

@section('title')
    Edit Order
@stop


@section('content')

    <h1>Edit Order</h1>

    @include('errors')

    <form method='POST' action='/orders/edit'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>

        <input type='hidden' name='id' value='{{ $order->id }}'>

        <div class='form-group'>
            <label class='control-label col-sm-2'>* Pet Name:</label>
              <div class='col-sm-10'>
                <input
                  class='form-control'
                  type='text'
                  id='pet_name'
                  name='pet_name'
                  value='{{ $order->pet_name }}'>
                </div>
        </div>


         <div class='form-group'>
           <div class='col-sm-offset-2 col-sm-10'>
             <div class='treatscontainer'>
               <div class='col1'>
                 <label for='treats'>Treats</label>
                 @foreach($treats_for_checkbox as $treat_id => $treat_name)
                    <?php $checked = (in_array($treat_name, $treats_for_this_order)) ? 'CHECKED' : '' ?>
                    <input {{ $checked }} type='checkbox' name='treats[]' value='{{$treat_id}}'> {{ $treat_name }}<br>
                 @endforeach
              </div>
              <div class='col2'>
                <label for='treats'>Quantity</label>
                @foreach($treats_for_inputbox as $treat_id => $treat_quantity)
                   <?php $post = (in_array($treats_for_inputbox, $treatquantities_for_this_order)) ? '$_POST' : '' ?>
                   <input {{ $post }} type='inputbox' name='treatsquantities[]' value='{{ $treat_quantity }}'> <br>
                @endforeach
             </div>
             <div class='col3'>
               <label for='treats'>Price ($)</label>
               @foreach($treats_for_display as $treat_id => $treat_price)
                  {{ $treat_price }} <br>
               @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
          <div class='accesoriescontainer'>
            <div class='col1'>
              <label for='accesories'>Accesories</label>
              @foreach($accesories_for_checkbox as $accesory_id => $accesory_name)
                <?php $checked = (in_array($accesory_name, $accesories_for_this_order)) ? 'CHECKED' : '' ?>
                <input {{ $checked }} type='checkbox' name='accesories[]' value='{{$accesory_id}}'> {{ $accesory_name }}<br>
              @endforeach
            </div>
            <div class='col2'>
              <label for='accesories'>Quantity</label>
              @foreach($accesories_for_inputbox as $accesory_id => $accesory_quantity)
                <input type='inputbox' class='quantityinputbox' name='accesoriesquantities[]' value='{{$accesory_quantity}}'> <br>
              @endforeach
            </div>
            <div class='col3'>
              <label for='accesories'>Price ($)</label>
              @foreach($accesoryprices_for_display as $accesory_id => $accesory_price)
                {{ $accesory_price }} <br>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
        <br>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>

@stop
