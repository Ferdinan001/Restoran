<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = food::all();
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/food'), $imageName);
            $validate['image'] = 'images/food/' . $imageName;
        }

        food::create($validate);

        return redirect()->route('food.index')->with('success', 'Food berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = food::find($id);
        if (! $food)
        {
            return redirect()->route('food.index')->with('error', 'Food tidak ditemukan!');
        }
        return view('food.show', compact('food'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $food = food::find($id);
        if (! $food)
        {
            return redirect()->route('food.index')->with('error', 'Food tidak ditemukan!');
        }
        return view('food.edit', compact('food'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $food = food::find($id);
        if (! $food)
        {
            return redirect()->route('food.index')->with('error', 'Food tidak ditemukan!');
        }

        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image'))
        {
            // Hapus gambar lama
            if ($food->image && file_exists(public_path($food->image)))
            {
                unlink(public_path($food->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/food'), $imageName);
            $validate['image'] = 'images/food/' . $imageName;
        }

        $food->update($validate);

        return redirect()->route('food.index')->with('success', 'Food berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = food::find($id);
        if (! $food)
        {
            return redirect()->route('food.index')->with('error', 'Food tidak ditemukan!');
        }

        // Hapus gambar
        if ($food->image && file_exists(public_path($food->image)))
        {
            unlink(public_path($food->image));
        }

        $food->delete();

        return redirect()->route('food.index')->with('success', 'Food berhasil dihapus!');
    }
}
