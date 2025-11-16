<?php

namespace App\Http\Controllers;

use App\Models\Packaging;
use Illuminate\Http\Request;

class PackagingController extends Controller
{
    // Список упаковок
    public function index()
    {
        $packagings = Packaging::all();
        return view('adminpanel.admin_packaging', compact('packagings'));
    }

    // Форма создания
    public function create()
    {
        return view('admin.packaging.create');
    }

    // Сохранение новой упаковки
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
        ]);

        Packaging::create($request->all());

        return redirect()->route('admin.packaging.index')->with('success', 'Упаковка успешно добавлена!');
    }

    // Форма редактирования
    public function edit(Packaging $packaging)
    {
        return view('admin.packaging.edit', compact('packaging'));
    }

    // Обновление
    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
        ]);

        $packaging->update($request->all());

        return redirect()->route('admin.packaging.index')->with('success', 'Упаковка успешно обновлена!');
    }

    // Удаление
    public function destroy(Packaging $packaging)
    {
        $packaging->delete();
        return redirect()->route('admin.packaging.index')->with('success', 'Упаковка удалена!');
    }

    // Метод для кастомной обертки
    public function storeCustom(Request $request)
    {
        // Валидация данных
        $request->validate([
            'material' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'decor' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $packaging = new Packaging();
        $packaging->name = 'Кастомная обертка';
        $packaging->description = 'Материал: '.$request->material.', Цвет: '.$request->color.($request->decor ? ', Декор: '.$request->decor : '');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('packaging', 'public');
            $packaging->image = $path;
        }

        $packaging->save();

        return redirect()->back()->with('success', 'Ваша кастомная обертка отправлена!');
    }
}
