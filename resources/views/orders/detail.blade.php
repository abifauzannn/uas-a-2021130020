@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row">

            <div class="col-md-8">
                <h1 class="mb-4">Order Details</h1>

                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Order Information</h4>
                        <p><strong>Status:</strong> {{ $order->status }}</p>
                        <p><strong>Total Quantity:</strong> {{ $order->orderMenus->sum('quantity') }}</p>
                        <p><strong>Total Price (Before Discount):</strong> Rp
                            {{ number_format(
                                $order->menus->sum(function ($menuItem) {
                                    return $menuItem->harga * $menuItem->pivot->quantity;
                                }),
                                0,
                                ',',
                                '.',
                            ) }}
                        </p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Menu Items</h4>
                        <ul class="list-group">
                            @foreach ($order->menus as $menuItem)
                                @php
                                    $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                    $subtotal = $discountedPrice * $menuItem->pivot->quantity;
                                @endphp
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ ucwords($menuItem->nama) }}</h5>
                                            <p class="mb-1">Price: Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                            </p>
                                            <p class="mb-1">Quantity: {{ $menuItem->pivot->quantity }}</p>
                                            <p class="mb-0">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>
                        <p><strong>Total Price (After Discount):</strong> Rp
                            {{ number_format(
                                $order->menus->sum(function ($menuItem) {
                                    $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                    return $discountedPrice * $menuItem->pivot->quantity;
                                }),
                                0,
                                ',',
                                '.',
                            ) }}
                        </p>
                        <p><strong>PPN (11%):</strong> Rp
                            {{ number_format(
                                $order->menus->sum(function ($menuItem) {
                                    $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                    return $discountedPrice * $menuItem->pivot->quantity;
                                }) * 0.11,
                                0,
                                ',',
                                '.',
                            ) }}
                        </p>
                        <p><strong>Total Price + VAT:</strong> Rp
                            {{ number_format(
                                $order->menus->sum(function ($menuItem) {
                                    $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                    return $discountedPrice * $menuItem->pivot->quantity;
                                }) * 1.11,
                                0,
                                ',',
                                '.',
                            ) }}
                        </p>
                    </div>
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#receiptModal">
                        Tampilkan Faktur
                    </button>
                </div>
            </div>

            <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="receiptModalLabel">Faktur Orderan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Status:</strong> {{ $order->status }}</p>
                            <p><strong>Total Quantity:</strong> {{ $order->orderMenus->sum('quantity') }}</p>
                            <p><strong>Total Price (Before Discount):</strong> Rp
                                {{ number_format(
                                    $order->menus->sum(function ($menuItem) {
                                        return $menuItem->harga * $menuItem->pivot->quantity;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </p>
                            <hr>
                            @foreach ($order->menus as $menuItem)
                                @php
                                    $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                    $subtotal = $discountedPrice * $menuItem->pivot->quantity;
                                @endphp
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ ucwords($menuItem->nama) }}</h5>
                                            <p class="mb-1">Price: Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                                            </p>
                                            <p class="mb-1">Quantity: {{ $menuItem->pivot->quantity }}</p>
                                            <p class="mb-0">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            <br>
                        <div class="d-flex justify-content-between">

                        </div>
                            <p><strong>Total Price (After Discount):</strong> Rp
                                {{ number_format(
                                    $order->menus->sum(function ($menuItem) {
                                        $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                        return $discountedPrice * $menuItem->pivot->quantity;
                                    }),
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </p>
                            <p><strong>PPN (11%):</strong> Rp
                                {{ number_format(
                                    $order->menus->sum(function ($menuItem) {
                                        $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                        return $discountedPrice * $menuItem->pivot->quantity;
                                    }) * 0.11,
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </p>
                            <p><strong>Total Price + VAT:</strong> Rp
                                {{ number_format(
                                    $order->menus->sum(function ($menuItem) {
                                        $discountedPrice = $menuItem->harga * (1 - ($menuItem->rekomendasi ? 0.1 : 0)); // Diskon hanya jika rekomendasi true
                                        return $discountedPrice * $menuItem->pivot->quantity;
                                    }) * 1.11,
                                    0,
                                    ',',
                                    '.',
                                ) }}
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
