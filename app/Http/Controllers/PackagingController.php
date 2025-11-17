<?php

namespace App\Http\Controllers;

use App\Models\Packaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackagingController extends Controller
{
    /**
     * Список всех упаковок
     */
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

    /**
     * Сохранение новой упаковки (обычная форма или модалка)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packaging', 'public');
        }

        $packaging = Packaging::create($data);

        // Если AJAX — возвращаем JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'packaging' => [
                    'id'    => $packaging->id,
                    'name'  => $packaging->name,
                    'price' => $packaging->price,
                    'description' => $packaging->description,
                    'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка успешно добавлена!');
    }

    /**
     * Получение данных упаковки для редактирования (AJAX)
     */
    public function edit(Packaging $packaging)
    {
        if (request()->ajax()) {
            return response()->json([
                'id'    => $packaging->id,
                'name'  => $packaging->name,
                'price' => $packaging->price,
                'description' => $packaging->description,
                'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
            ]);
        }

        return view('admin.packaging.edit', compact('packaging'));
    }

    /**
     * Обновление упаковки
     */
    public function update(Request $request, Packaging $packaging)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['name', 'price', 'description']);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение
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
                    'description' => $packaging->description,
                    'image_url' => $packaging->image ? asset('storage/' . $packaging->image) : null,
                ]
            ]);
        }

        return redirect()->route('admin.packaging.admin')
            ->with('success', 'Упаковка успешно обновлена!');
    }

    /**
     * Удаление упаковки
     */
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
