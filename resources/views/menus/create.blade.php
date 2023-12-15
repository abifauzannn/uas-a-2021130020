<!-- resources/views/menus/create.blade.php -->

@extends('layouts.master')

@section('content')

<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>Add New Menu</h1>
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
            <form method="POST" action="{{ route('menus.store') }}">
                @csrf

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="nama">Nama:</label>
                    </div>
                    <div class="col-2">
                        <input type="text" id="nama" name="nama" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="kategori">Kategori:</label>
                    </div>
                    <div class="col-2">
                        <input type="text" id="kategori" name="kategori" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="harga">Harga:</label>
                    </div>
                    <div class="col-2">
                        <input type="number" id="harga" name="harga" step="0.01" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-2">
                        <label for="rekomendasi">Rekomendasi:</label>
                    </div>
                    <div class="col-2">
                        <input type="hidden" name="Not Rekomendasi" value="0">
                        <input type="checkbox" id="rekomendasi" name="rekomendasi" value="1">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <button type="submit">Create</button>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-4">
                        <a href="{{ route('menus.index') }}">Back to List</a>
                    </div>
                </div>

        </div>
    </div>






    <!-- Use a hidden input to send 'false' if checkbox is not checked -->





    <!-- Add a field for 'kategori' -->



    </form>



@endsection
