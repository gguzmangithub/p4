@extends('layouts.master')

@section('petname')
    Delete Order
@stop


@section('content')

    <h3>Delete Order</h3>

    <p>
        Are you sure you want to delete the order for <em>{{ $order->pet_name }} created on {{ date('F d, Y', strtotime($order->created_at)) }}</em>?
    </p>

    <p>
        <a href='/orders/delete/{{$order->id}}'>Yes</a>
    </p>

@stop
