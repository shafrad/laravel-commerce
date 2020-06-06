@extends('products.layout')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Order Sukses!</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Order No:</strong>
                {{ $order->order_number }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {{ $order->status }}
            </div>
        </div>
        @foreach ($order->carts as $ord)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product name:</strong>
                {{ $ord->product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantity:</strong>
                {{ $ord->quantity }} pcs
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Total:</strong>
                @php
                 $total = $ord->product->price * $ord->quantity
                @endphp
                {{ $total }}
            </div>
        </div>
        @endforeach
    </div>

@endsection