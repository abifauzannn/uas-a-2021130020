<!-- resources/views/menus/create.blade.php -->

@extends('layouts.master')

@section('content')
    <h1>Create Menu</h1>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('menus.store') }}">
        @csrf

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="rekomendasi">Rekomendasi:</label>
        <!-- Use a hidden input to send 'false' if checkbox is not checked -->
        <input type="hidden" name="rekomendasi" value="0">
        <input type="checkbox" id="rekomendasi" name="rekomendasi" value="1">

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" step="0.01" required>

        <!-- Add a field for 'kategori' -->
        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" required>

        <button type="submit">Create</button>
    </form>


    <a href="{{ route('menus.index') }}">Back to List</a>
@endsection
