<?php

namespace App\Http\Controllers;

use App\Models\Packaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackagingController extends Controller
{
    public function admin()
    {
        $packagings = Packaging::all();
        return view('adminpanel.admin_packaging', compact('packagings'));
    }

    public function index(Request $request)
    {
        $query = Packaging::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $packagings = $query->get();

        return view('site.packaging', compact('packagings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:packaging,name,' . ($packaging->id ?? 'NULL'),
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Введите название упаковки.',
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не должно превышать 255 символов.',
            'name.unique' => 'Такая упаковка уже существует.',

            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',

        ]);


        $data = $request->only(['name', 'price']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packaging', 'public');
        }

        $packaging = Packaging::create($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'packaging' => [
                    'id'    => $packaging->id,
                    'name'  => $packaging->name,
                    'price' => $packaging->price,
                    'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка успешно добавлена!');
    }

    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:packaging,name,' . ($packaging->id ?? 'NULL'),
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'name.required' => 'Введите название упаковки.',
            'name.string' => 'Название должно быть строкой.',
            'name.max' => 'Название не должно превышать 255 символов.',
            'name.unique' => 'Такая упаковка уже существует.',

            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть отрицательной.',

            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы: jpeg, png, jpg, gif, webp.',
            'image.max' => 'Размер изображения не должен превышать 2 МБ.',

        ]);


        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            if ($packaging->image) {
                Storage::disk('public')->delete($packaging->image);
            }
            $data['image'] = $request->file('image')->store('packaging', 'public');
        }

        $packaging->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'packaging' => [
                    'id'    => $packaging->id,
                    'name'  => $packaging->name,
                    'price' => $packaging->price,
                    'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка успешно обновлена!');
    }

    public function destroy(Packaging $packaging)
    {
        if ($packaging->image) {
            Storage::disk('public')->delete($packaging->image);
        }

        $packaging->delete();

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка удалена!');
    }
}
