<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use Illuminate\Http\Request;

class BouquetController extends Controller
{
    public function index(Request $request)
    {
        $query = Bouquet::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $bouquets = $query->get();

        return view('site.bouquets', compact('bouquets'));
    }

    public function admin()
    {
        $bouquets = Bouquet::all();
        return view('adminpanel.admin_bouquets', compact('bouquets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'zodiac_sign' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('bouquets', 'public');
        }

        Bouquet::create($data);

        // Редирект на страницу админки после добавления
        return redirect()->route('admin.bouquets.admin')->with('success', 'Букет добавлен!');
    }

    public function update(Request $request, Bouquet $bouquet)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'zodiac_sign' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('bouquets', 'public');
        }

        $bouquet->update($data);

        // Редирект на страницу админки после редактирования
        return redirect()->route('admin.bouquets.admin')->with('success', 'Букет обновлён!');
    }

    public function destroy(Bouquet $bouquet)
    {
        $bouquet->delete();
        return redirect()->back()->with('success', 'Букет удалён!');
    }
}
