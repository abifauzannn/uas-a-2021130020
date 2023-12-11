<!-- resources/views/menus/edit.blade.php -->

@extends('layouts.master')

@section('content')
    <h1>Edit Menu</h1>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.update', $menu) }}" method="POST">
        @method('PUT')
        @csrf

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}" required>

        <label for="rekomendasi">Rekomendasi:</label>
        <input type="checkbox" id="rekomendasi" name="rekomendasi" value="1" {{ $menu->rekomendasi ? 'checked' : '' }}>


        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" step="0.01" required>

        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $menu->kategori) }}" required>

        <button type="submit">Update</button>
    </form>


    <a href="{{ route('menus.index') }}">Back to List</a>
@endsection
