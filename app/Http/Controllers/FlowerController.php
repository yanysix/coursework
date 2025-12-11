<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

class FlowerController extends Controller
{

    public function admin()
    {
        $flowers = Flower::all();
        return view('adminpanel.admin_flowers', compact('flowers'));
    }


    public function index(Request $request)
    {
        $query = Flower::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }


        $flowers = $query->get();

        return view('site.flower', compact('flowers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:flowers,name',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Введите название цветка.',
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не должно превышать 255 символов.',
            'name.unique' => 'Такой цветок уже существует.',

            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',

        ]);


        $data = $request->only('name', 'price');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('flowers', 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = null;
        }

        $flower = Flower::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'flower' => [
                    'id' => $flower->id,
                    'name' => $flower->name,
                    'price' => $flower->price,
                    'image_url' => $flower->image ? asset('storage/' . $flower->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.flowers.admin')->with('success', 'Цветок успешно добавлен!');
    }


    public function edit(Flower $flower)
    {
        return view('admin.flowers.edit', compact('flower'));
    }

    public function update(Request $request, Flower $flower)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:flowers,name,' . $flower->id,
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'price');

        if ($request->hasFile('image')) {
            if ($flower->image) {
                \Storage::disk('public')->delete($flower->image);
            }
            $data['image'] = $request->file('image')->store('flowers', 'public');
        }

        $flower->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'flower' => [
                    'id' => $flower->id,
                    'name' => $flower->name,
                    'price' => $flower->price,
                    'image_url' => $flower->image ? asset('storage/' . $flower->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.flowers.admin')->with('success', 'Цветок успешно обновлен!');
    }


    public function destroy(Flower $flower)
    {
        $flower->delete();
        return redirect()->route('admin.flowers.admin')->with('success', 'Цветок удален!');
    }
}
