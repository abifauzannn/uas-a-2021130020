<!-- resources/views/menus/show.blade.php -->

@extends('layouts.master')

@section('content')
    <h1>{{ $menu->nama }}</h1>

    <p>ID: {{ $menu->id }}</p>
    <p>Nama: {{ $menu->nama }}</p>
    <p>Rekomendasi: {{ $menu->rekomendasi ? 'Yes' : 'No' }}</p>
    <p>Harga: {{ $menu->harga }}</p>

    <a href="{{ route('menus.index') }}">Back to List</a>
@endsection
