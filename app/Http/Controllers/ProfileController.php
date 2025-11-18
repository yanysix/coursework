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

        // ----- Обновление личной информации -----
        if ($request->has('update_info')) {
            $request->validate([
                'name'  => 'required|string|min:2|max:50|regex:/^[А-Яа-яA-Za-z\s\-]+$/u',
                'email' => 'required|string|email:rfc,dns|max:255|unique:users,email,' . $user->id,
            ], [
                'name.required' => 'Введите ваше имя.',
                'name.min' => 'Имя должно содержать минимум 2 символа.',
                'name.max' => 'Имя не должно превышать 50 символов.',
                'name.regex' => 'Имя может содержать только буквы, пробелы и дефис.',

                'email.required' => 'Введите email.',
                'email.email' => 'Введите корректный email.',
                'email.unique' => 'Этот email уже зарегистрирован.',
            ]);

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->save();

            return back()->with('success_info', 'Личная информация обновлена!');
        }

        // ----- Обновление пароля -----
        if ($request->has('update_password')) {
            $request->validate([
                'password' => 'required|string|min:6|max:64|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d).{6,}$/',
            ], [
                'password.required' => 'Введите пароль.',
                'password.min' => 'Пароль должен содержать минимум 6 символов.',
                'password.max' => 'Пароль слишком длинный.',
                'password.confirmed' => 'Пароли не совпадают.',
                'password.regex' => 'Пароль должен содержать хотя бы одну букву и одну цифру.',
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

        $request->validate([
            'password' => 'required|string',
        ], [
            'password.required' => 'Введите пароль для подтверждения.',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Неверный пароль']);
        }

        Auth::logout();
        $user->delete();

        return redirect()->route('main')->with('success', 'Ваш аккаунт удалён.');
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'avatar.required' => 'Выберите изображение для аватара.',
            'avatar.image' => 'Файл должен быть изображением.',
            'avatar.mimes' => 'Допустимые форматы: jpeg, png, jpg, gif, webp.',
            'avatar.max' => 'Размер изображения не должен превышать 2 МБ.',
        ]);

        if ($user->avatar) {
            \Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return back()->with('success_info', 'Аватар успешно обновлён!');
    }

}
