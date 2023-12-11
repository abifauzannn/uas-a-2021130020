<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'rekomendasi' => 'nullable|boolean',
            'harga' => 'required|numeric',
            'kategori' => 'required|string',
        ]);

        // Extract the first 3 characters of the 'nama' and make them uppercase
        $categoryAbbreviation = strtoupper(substr($validated['kategori'], 0, 3));

        // Get the maximum 'id' as an integer
        $maxId = (int) Menu::max('id');

        // Generate a new 'menu' instance
        $menu = new Menu([
            'nama' => $validated['nama'],
            'rekomendasi' => $request->has('rekomendasi'),
            'harga' => $validated['harga'],
            'kategori' => $validated['kategori'],
        ]);

        // Set the 'id' attribute using the generated ID
        $generatedID = $categoryAbbreviation . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
        $menu->id = $generatedID;

        // Save the 'menu' instance to the database
        $menu->save();

        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {

        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
{
    $validated = $request->validate([
        'nama' => 'required|string',
        'rekomendasi' => 'nullable|boolean',
        'harga' => 'required|numeric',
        'kategori' => 'required|string',
    ]);

    // Extract the first 3 characters of the 'kategori' and make them uppercase
    $categoryAbbreviation = strtoupper(substr($validated['kategori'], 0, 3));

    $maxId = (int) Menu::max('id');

    // Update the 'menu' instance with the new values
    $menu->nama = $validated['nama'];
    $menu->rekomendasi = $request->has('rekomendasi');
    $menu->harga = $validated['harga'];
    $menu->kategori = $validated['kategori'];

    // If 'id' is derived from 'kategori', update it accordingly
    $generatedID = $categoryAbbreviation . str_pad($maxId + 1, 3, '0', STR_PAD_LEFT);
        $menu->id = $generatedID;

    // Save the changes to the 'menu' instance
    $menu->save();

    return redirect()->route('menus.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

    return redirect()->route('menus.index')->with('success', 'Book deleted successfully.');
    }
}
