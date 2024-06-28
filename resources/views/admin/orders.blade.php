@extends('admin.index')

@section('admin')
<div class="container-lg">
    <div class="row">
        <h1>Customer Orders</h1>

        <form action="{{ url('/search-results') }}" method="get">
            @csrf
            <input type="text" name="search" style="color:black"/>
            <input type="submit" value="Search" class="btn btn-primary"/>
        </form>

        <table class="table table-hover mt-4 datatable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Customer Name</th>
                    <th>Foodname</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp

            
                @if ($order)
                    @foreach ($order->Orderitem as $item)
                        @php
                            $subtotal = $item->product->discount_price * $item->quantity;
                            $totalAmount += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ $item->product->title }}</td>
                            <td>₹{{ number_format($item->product->discount_price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₹{{ number_format($subtotal, 2) }}</td>
                            <td>
                                @if ($order->address)
                                    <p>{{ $order->address->address_id }}</p>
                                @else
                                    <p>No address associated with this order.</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No orders found.</td>
                    </tr>
                @endif

                <tr>
                    <td colspan="5" style="text-align: right;"><strong>Sub Total:</strong></td>
                    <td><strong>₹{{ number_format($totalAmount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
