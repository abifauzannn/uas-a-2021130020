<!-- resources/views/menus/index.blade.php -->

@extends('layouts.master')

@section('content')
    <h1>List Menus</h1>

    <a href="{{ route('menus.create') }}">Create Menu</a>

    <ul>
        @foreach ($menus as $menu)
            <li>
                {{ $menu->id }} - {{ $menu->nama }} - {{ $menu->rekomendasi ? 'Rekomendasi' : 'Not Rekomendasi' }} - {{ $menu->harga }}
                <a href="{{ route('menus.show', $menu->id) }}">Show</a>
                <a href="{{ route('menus.edit', $menu->id) }}">Edit</a>

                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
