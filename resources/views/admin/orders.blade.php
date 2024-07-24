@extends('admin.index')
@section('admin')
<div class="container-lg">
    <div class="row">
        <h1>Customer Orders</h1>
        <table class="table table-hover mt-4 datatable">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Customer Name</th>
                    <th>Foodname</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Contact Info</th> 
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0; 
                $gstRate = 18; 
                $deliveryCharge = 50;
                @endphp

                @foreach ($order->orderItems as $index => $item)
                @php
                $itemTotalPrice = $item->product->discount_price * $item->quantity;
                $subtotal += $itemTotalPrice;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $item->product->title }}</td>
                    <td>₹{{ number_format($item->product->discount_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($itemTotalPrice, 2) }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td> 
                        @foreach ($address as $addr)
                        <span>{{ $addr->fullname }}</span><br>
                        <span>{{ $addr->alt_contact }}</span><br>
                        <span>{{ $addr->landmark }}, {{ $addr->street_name }}, {{ $addr->area }}, {{ $addr->pincode }}, {{ $addr->city }}, {{ $addr->state }}</span><br>
                        @endforeach
                    </td>
                </tr>
                @endforeach

                <tr>
                    <td colspan="5" align="right">Subtotal:</td>
                    <td>₹{{ number_format($subtotal, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="5" align="right">GST ({{ $gstRate }}%):</td>
                    <td>₹{{ number_format(($subtotal * $gstRate) / 100, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="5" align="right">Delivery Charge:</td>
                    <td>₹{{ number_format($deliveryCharge, 2) }}</td>
                </tr>

                <tr>
                    <td colspan="5" align="right"><strong>Total Amount:</strong></td>
                    <td><strong>₹{{ number_format($subtotal + ($subtotal * $gstRate / 100) + $deliveryCharge, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
