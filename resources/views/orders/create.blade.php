@extends('layouts.master')

@section('title')
    Create Order
@stop


{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
    {{-- <link href="/css/books/create.css" type='text/css' rel='stylesheet'> --}}
@stop



@section('content')

    <h2>Add a new order</h2>

    @include('errors')

    <form method='POST' action='/orders/create' class='form-horizontal'>

        <input type='hidden' value='{{ csrf_token() }}' name='_token'>

        <div class='form-group'>
            <label class='control-label col-sm-2'>* Pet Name:</label>
              <div class='col-sm-10'>
                <input
                  class='form-control'
                  type='text'
                  id='pet_name'
                  name='pet_name'
                  value='{{ old('pet_name') }}'>
                </div>
        </div>

                <div class='form-group'>
                  <div class='col-sm-offset-2 col-sm-10'>
                    <div class='treatscontainer'>
                      <div class='col1'>
                        <label for='treats'>Treats</label>
                        @foreach($treats_for_checkbox as $treat_id => $treat_name)
                          <input type='checkbox' name='treats[]' value='{{$treat_id}}'> {{ $treat_name }} <br>
                        @endforeach
                      </div>
                      <div class='col2'>
                        <label for='treats'>Quantity</label>
                        @foreach($treats_for_inputbox as $treat_id => $treat_quantity)
                          <input type='inputbox' class='quantityinputbox' name='treatquantities[]' value='0'> <br>
                        @endforeach
                      </div>
                      <div class='col3'>
                        <label for='treats'>Price ($)</label>
                        @foreach($accesoryprices_for_display as $treat_id => $treat_price)
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
                          <input type='checkbox' name='accesories[]' value={{$accesory_id}}> {{ $accesory_name }} <br>
                        @endforeach
                      </div>
                      <div class='col2'>
                        <label for='accesories'>Quantity</label>
                        @foreach($accesories_for_inputbox as $accesory_id => $accesory_quantity)
                          <input type='inputbox' class='quantityinputbox' name='accesoriesquantities[]' value='0'> <br>
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
                    <button type="submit" class="btn btn-warning">Add order</button>
                  </div>
                </div>
    </form>

@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
    {{-- <script src="/js/books/create.js"></script> --}}
@stop
