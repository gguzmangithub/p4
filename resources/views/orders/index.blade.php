@extends('layouts.master')

@section('title')
    Your Orders
@stop

@section('content')

    <h2>Your Orders For:</h2>

    @if(sizeof($orders) == 0)
      <p>We do not have any orders from you, <a href='/orders/create'>Please add an order for your furry friend</a> </p>
    @else
        @foreach($orders as $order)
            <div>
                <h3>{{ $order->pet_name }} ordered on {{ date('F d, Y', strtotime($order->created_at)) }}</h3>
                <a class='EditDelete' href='/orders/edit/{{$order->id}}'>Edit</a> |
                <a href='/orders/confirm-delete/{{$order->id}}'>Delete</a><br>
                {{-- <img src='{{ $book->cover }}'> --}}
            </div>
        @endforeach
    @endif

@stop
