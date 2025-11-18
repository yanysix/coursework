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

    public function index()
    {
        $packagings = Packaging::all();
        return view('site.packaging', compact('packagings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:packagings,name,' . ($packaging->id ?? 'NULL'),
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'zodiac_sign' => 'nullable|string|in:Овен,Телец,Близнецы,Рак,Лев,Дева,Весы,Скорпион,Стрелец,Козерог,Водолей,Рыбы',
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

            'zodiac_sign.in' => 'Выберите корректный знак зодиака.',
        ]);


        $data = $request->only(['name', 'price', 'zodiac_sign']);

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
                    'zodiac_sign' => $packaging->zodiac_sign,
                    'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка успешно добавлена!');
    }

    public function edit(Packaging $packaging)
    {
        if (request()->ajax()) {
            return response()->json([
                'id'    => $packaging->id,
                'name'  => $packaging->name,
                'price' => $packaging->price,
                'zodiac_sign' => $packaging->zodiac_sign,
                'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
            ]);
        }

        return view('admin.packaging.edit', compact('packaging'));
    }

    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:packagings,name,' . ($packaging->id ?? 'NULL'),
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'zodiac_sign' => 'nullable|string|in:Овен,Телец,Близнецы,Рак,Лев,Дева,Весы,Скорпион,Стрелец,Козерог,Водолей,Рыбы',
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

            'zodiac_sign.in' => 'Выберите корректный знак зодиака.',
        ]);


        $data = $request->only(['name', 'price', 'description', 'zodiac_sign']);

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
                    'zodiac_sign' => $packaging->zodiac_sign,
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
