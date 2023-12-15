<!-- resources/views/menus/index.blade.php -->

@extends('layouts.master')

@section('title', 'Data Menu')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded mb-4">
        <h1>All Menus</h1>
        {{-- Add button --}}
        <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm">Add New Menu</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success mt-4">
            {{ session()->get('success') }}
        </div>
    @endif

    <table id="example" class="table row-border hover" style="width:100%">
        <thead>
            <tr>
                <th>Id Menu</th>
                <th>Nama Menu</th>
                <th>Kategori Menu</th>
                <th>Rekomendasi</th>
                <th>Harga</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menus as $menu)
                <tr>
                    <td>{{ $menu->id }}</td>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->kategori }}</td>
                    <td>{{ $menu->rekomendasi ? 'Rekomendasi' : 'Not Rekomendasi' }}</td>
                    <td>{{ $menu->harga }}</td>
                    <td>{{ $menu->created_at }}</td>
                    <td>{{ $menu->updated_at }}</td>
                    <td>
                        <a href="{{ route('menus.show', $menu) }}" class="btn btn-success btn-sm">Show</a>
                        <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline-block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No menus found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery('#example').DataTable();
        });
    </script>
@endsection
