@extends('layouts.master')

@section('title', 'Daftar Order')

@section('content')
<div class="mt-4 p-5 bg-black text-white rounded mb-4">
    <h1>All Orders</h1>
    {{-- Add button --}}
    <a href="{{ route('order') }}" class="btn btn-primary btn-sm">Tambah Orderan Baru</a>
</div>

<table id="example" class="table row-border hover" style="width:100%">
    <thead>
        <tr>
            <th>Id Order</th>
            <th>Status Pembayaran</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success btn-sm">Show Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Tidak ada data Orderan</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Include jQuery before DataTables script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    jQuery(document).ready(function(){
    jQuery('#example').DataTable();
});
</script>

@endsection
