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
        $cartItemsBouquets = $cart->bouquets;

        $total = $cartItemsFlowers->sum('price') + $cartItemsPackagings->sum('price')
            + $cartItemsBouquets->sum('price');

        return view('site.cart', compact('cartItemsFlowers', 'cartItemsPackagings',
            'cartItemsBouquets','total'));
    }

    // Добавление упаковки в корзину
    public function addPackaging(Request $request)
    {
        $request->validate([
            'packaging_id' => 'required|exists:packaging,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['fk_user_id' => Auth::id()]);

        $cartPackaging = $cart->packagings()->where('fk_packaging_id', $request->packaging_id)->first();

        if ($cartPackaging) {
            $cartPackaging->count += $request->count;
            $cartPackaging->price = $request->price * $cartPackaging->count;
            $cartPackaging->save();
        } else {
            $cart->packagings()->create([
                'fk_packaging_id' => $request->packaging_id,
                'price' => $request->price * $request->count,
                'count' => $request->count,
            ]);
        }

        $this->updateTotal($cart);

        return redirect()->back()->with('success', 'Упаковка добавлена в корзину!');
    }


    public function addFlower(Request $request)
    {
        $request->validate([
            'flower_id' => 'required|exists:flowers,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
        ], [
            'flower_id.required' => 'Выберите цветок.',
            'flower_id.exists' => 'Такого цветка не существует.',
            'price.required' => 'Цена цветка обязательна.',
            'price.numeric' => 'Цена должна быть числом.',
            'price.min' => 'Цена не может быть отрицательной.',
            'count.required' => 'Укажите количество.',
            'count.integer' => 'Количество должно быть целым числом.',
            'count.min' => 'Количество должно быть хотя бы 1.',
        ]);

        $cart = Cart::firstOrCreate(['fk_user_id' => Auth::id()]);

        // Проверяем, есть ли уже этот цветок в корзине
        $cartFlower = $cart->flowers()->where('fk_flower_id', $request->flower_id)->first();
        if ($cartFlower) {
            $cartFlower->count += $request->count;
            $cartFlower->price = $request->price * $cartFlower->count; // обновляем цену с учетом количества
            $cartFlower->save();
        } else {
            $cart->flowers()->create([
                'fk_flower_id' => $request->flower_id,
                'price' => $request->price * $request->count,
                'count' => $request->count,
            ]);
        }

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

    public function addBouquet(Request $request)
    {
        $request->validate([
            'bouquet_id' => 'required|exists:bouquets,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(['fk_user_id' => Auth::id()]);

        $cartBouquet = $cart->bouquets()->where('fk_bouquet_id', $request->bouquet_id)->first();

        if ($cartBouquet) {
            $cartBouquet->count += $request->count;
            $cartBouquet->price = $request->price * $cartBouquet->count;
            $cartBouquet->save();
        } else {
            $cart->bouquets()->create([
                'fk_bouquet_id' => $request->bouquet_id,
                'price' => $request->price * $request->count,
                'count' => $request->count,
            ]);
        }

        $this->updateTotal($cart);

        return redirect()->back()->with('success', 'Букет добавлен в корзину!');
    }

    public function updateItemCount(Request $request, $type, $id)
    {
        $request->validate([
            'action' => 'required|in:increment,decrement'
        ]);

        $cart = Cart::where('fk_user_id', Auth::id())->firstOrFail();

        if ($type === 'flower') {
            $item = $cart->flowers()->where('id', $id)->firstOrFail();
        } elseif ($type === 'packaging') {
            $item = $cart->packagings()->where('id', $id)->firstOrFail();
        } elseif ($type === 'bouquet') {
            $item = $cart->bouquets()->where('id', $id)->firstOrFail();
        } else {
            return redirect()->back();
        }

        // Сохраняем старое количество
        $oldCount = $item->count;

        if ($request->action === 'increment') {
            $item->count += 1;
        } elseif ($request->action === 'decrement' && $item->count > 1) {
            $item->count -= 1;
        }

        // Пересчёт цены исходя из unit price
        $unitPrice = $item->price / max($oldCount, 1); // берем старое количество
        $item->price = $unitPrice * $item->count;
        $item->save();

        // Пересчёт общей суммы корзины
        $this->updateTotal($cart);

        return redirect()->back();
    }



    // Пересчёт общей суммы корзины
    protected function updateTotal(Cart $cart)
    {
        $total = $cart->flowers->sum(fn($item) => $item->price)
            + $cart->packagings->sum(fn($item) => $item->price)
            + $cart->bouquets->sum(fn($item) => $item->price);

        $cart->update(['total_amount' => $total]);
    }

}
