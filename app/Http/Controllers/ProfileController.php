<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth');
        }

        return view('site.profile', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth'); // если пользователь не авторизован, редирект на логин
        }

        return view('site.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Обновление личной информации
        if ($request->has('update_info')) {
            $request->validate([
                'name'  => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            ]);

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->save();

            return back()->with('success_info', 'Личная информация обновлена!');
        }

        // Обновление пароля
        if ($request->has('update_password')) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success_password', 'Пароль успешно обновлён!');
        }

        return back();
    }
    public function delete(Request $request)
    {
        $user = Auth::user();

        // Проверяем пароль перед удалением
        $request->validate([
            'password' => 'required',
        ]);

        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Неверный пароль']);
        }

        Auth::logout(); // выходим из аккаунта
        $user->delete(); // удаляем пользователя

        return redirect()->route('main')->with('success', 'Ваш аккаунт удалён'); // редирект на главную
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Удаляем старый аватар если есть
        if ($user->avatar) {
            \Storage::delete($user->avatar);
        }

        // Сохраняем новый аватар
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return redirect()->back()->with('success_info', 'Аватар успешно обновлён!');
    }


}
