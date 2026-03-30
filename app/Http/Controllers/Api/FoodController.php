<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use illuminate\http\request;
use illuminate\support\Facades\validator;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        $foods->transform(function ($food) {
            if ($food->image) {
                $food->image_url = url($food->image);
            }
            return $food;
        });
        return response()->json([
            'success' => true,
            'message' => 'List Data Food',
            'data' => $foods
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'
            => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }
        // Simpan gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }
        // buat data ke database
        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Food created successfully',
            'data' => $food
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::find($id);
        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found'
            ], 404);
        }
        if ($food->image) {
            $food->image_url = url($food->image);
        }
        return response()->json([
            'success' => true,
            'message' => 'Food details',
            'data' => $food
        ], 200);
    }


    public function update(Request $request, string $id)
    {
        $food = Food::find($id);
        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        // Simpan gambar
        $imagePath = $food->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }

        // Update data makanan
        $food->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Food updated successfully',
            'data' => $food
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::find($id);
        if (!$food) {
            return response()->json([
                'success' => false,
                'message' => 'Food not found'
            ], 404);
        }

        // Hapus gambar jika ada
        if ($food->image) {
            Storage::delete($food->image);
        }

        $food->delete();

        return response()->json([
            'success' => true,
            'message' => 'Food deleted successfully'
        ], 200);
    }
}
