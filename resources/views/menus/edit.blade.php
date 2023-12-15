<!-- resources/views/menus/edit.blade.php -->

@extends('layouts.master')

@section('content')

    <div class="mt-4 p-5 rounded">
        <h1>Edit Menu</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row my-4">
        <div class="col-12 px-5">
            <form method="POST" action="{{ route('menus.update', $menu->id) }}">
                @csrf
                @method('PUT') <!-- Use the PUT method for updates -->

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="nama">Nama:</label>
                    </div>
                    <div class="col-2">
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="kategori">Kategori:</label>
                    </div>
                    <div class="col-2">
                        <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $menu->kategori) }}" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="harga">Harga:</label>
                    </div>
                    <div class="col-2">
                        <input type="number" id="harga" name="harga" step="0.01" value="{{ old('harga', $menu->harga) }}" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="rekomendasi">Rekomendasi:</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" id="rekomendasi" name="rekomendasi" value="1" {{ $menu->rekomendasi ? 'checked' : '' }}>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <button type="submit">Update</button>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <a href="{{ route('menus.index') }}">Back to List</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

