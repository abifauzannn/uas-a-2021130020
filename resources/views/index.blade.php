<!-- resources/views/index.blade.php -->
@extends('layouts.master')

@section('title', 'Halaman Utama')

@section('content')
<div class="container-fluid mt-5">
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h2 class="card-title">Informasi Total Data</h2>
            <p class="card-text">Total Data Menu: {{ $totalMenu }}</p>
            <p class="card-text">Total Data Order: {{ $totalOrder }}</p>
            <a href="{{ route('orders.list') }}" class="btn btn-primary">View Order List</a>
    </div>

    <nav class="mt-3">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Halaman Utama</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('menus.index') }}">Halaman Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('order') }}">Halaman Order</a></li>
        </ul>
    </nav>

    @if (session()->has('success'))
        <div class="alert alert-success mt-4">
            {{ session()->get('success') }}
        </div>
    @endif

@endsection
