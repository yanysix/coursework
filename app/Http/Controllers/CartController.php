<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartFlowers;
use App\Models\CartPackagings;
use App\Models\Flower;
use App\Models\Packaging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Получение корзины пользователя
    public function index()
    {
        $cart = Cart::with(['flowers', 'packagings'])->firstOrCreate([
            'fk_user_id' => Auth::id()
        ]);

        $cartItemsFlowers = $cart->flowers;
        $cartItemsPackagings = $cart->packagings;

        $total = $cartItemsFlowers->sum('price') + $cartItemsPackagings->sum('price');

        return view('site.cart', compact('cartItemsFlowers', 'cartItemsPackagings', 'total'));
    }

    // Добавление упаковки в корзину
    public function addPackaging(Request $request)
    {
        $request->validate([
            'packaging_id' => 'required|exists:packaging,id',
            'price' => 'required|numeric',
        ]);

        $cart = Cart::firstOrCreate(['fk_user_id' => Auth::id()]);

        $cart->packagings()->create([
            'fk_packaging_id' => $request->packaging_id,
            'price' => $request->price
        ]);

        $this->updateTotal($cart);

        return redirect()->back()->with('success', 'Упаковка добавлена в корзину!');
    }

    // Добавление цветка в корзину
    public function addFlower(Request $request)
    {
        $request->validate([
            'flower_id' => 'required|exists:flowers,id',
            'price' => 'required|numeric',
        ]);

        $cart = Cart::firstOrCreate(['fk_user_id' => Auth::id()]);

        $cart->flowers()->create([
            'fk_flower_id' => $request->flower_id,
            'price' => $request->price
        ]);

        $this->updateTotal($cart);

        return redirect()->back()->with('success', 'Цветок добавлен в корзину!');
    }

    // Удаление элемента из корзины (цветок или упаковка)
    public function removeItem($type, $id)
    {
        $cart = Cart::where('fk_user_id', Auth::id())->firstOrFail();

        if ($type === 'flower') {
            $item = $cart->flowers()->where('id', $id)->firstOrFail();
            $item->delete();
        } elseif ($type === 'packaging') {
            $item = $cart->packagings()->where('id', $id)->firstOrFail();
            $item->delete();
        }

        $this->updateTotal($cart);

        return redirect()->back()->with('success', 'Товар удалён из корзины!');
    }

    // Пересчёт общей суммы корзины
    protected function updateTotal(Cart $cart)
    {
        $total = $cart->flowers->sum('price') + $cart->packagings->sum('price');
        $cart->update(['total_amount' => $total]);
    }
}
