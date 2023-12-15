<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{

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

    // Extract the first 3 characters of the 'kategori' and make them uppercase
    $categoryAbbreviation = strtoupper(substr($validated['kategori'], 0, 3));

    // Generate a random 3-digit number
    $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

    // Combine the 'categoryAbbreviation' and random digits
    $generatedID = $categoryAbbreviation . $randomDigits;

    // Create a new 'menu' instance
    $menu = new Menu([
        'id' => $generatedID,
        'nama' => $validated['nama'],
        'rekomendasi' => $request->has('rekomendasi'),
        'harga' => $validated['harga'],
        'kategori' => $validated['kategori'],
    ]);

    // Save the 'menu' instance to the database
    $menu->save();

    return redirect()->route('index')->with('success', 'Menu added successfully.');
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


    $categoryAbbreviation = strtoupper(substr($validated['kategori'], 0, 3));


    $existingRandomDigits = substr($menu->id, 3);


    $generatedID = $categoryAbbreviation . $existingRandomDigits;

    $menu->nama = $validated['nama'];
    $menu->rekomendasi = $request->has('rekomendasi');
    $menu->harga = $validated['harga'];
    $menu->kategori = $validated['kategori'];


    $menu->id = $generatedID;


    $menu->save();

    return redirect()->route('menus.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

    return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
