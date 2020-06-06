@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel</h2>
            </div>
            <div class="pull-right">
                <!-- <a class="btn btn-success" href="{{ route('dashboards.products.create') }}"> Create New Product</a> -->
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Total</th>
            <th>User</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($orders as $order)
        <tr>
            <td>{{ ++$i }}</td>
            @foreach ($order->carts as $ord)
                <td>{{ $ord->product->name }}</td>
            @endforeach
            @foreach ($order->carts as $ord)
                @php
                 $total = $ord->product->price * $ord->quantity
                @endphp
                <td>{{ $total }}</td>
            @endforeach
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <form action="{{ route('dashboards.orders.destroy',$order->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('dashboards.orders.edit',$order->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $orders->links() !!}

@endsection