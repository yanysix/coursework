<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Валидация
        $request->validate([
            'name' => 'required|string|min:2|max:50|unique:users,name|regex:/^[А-Яа-яA-Za-z\s\-]+$/u',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:64|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d).{6,}$/'
        ], [
            'name.required' => 'Введите ваше имя.',
            'name.min' => 'Имя должно содержать минимум 2 символа.',
            'name.max' => 'Имя не должно превышать 50 символов.',
            'name.regex' => 'Имя может содержать только буквы, пробелы и дефис.',
            'name.unique' => 'Такое имя уже занято',

            'email.required' => 'Введите email.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Этот email уже зарегистрирован.',
            'email.max' => 'Email не должен превышать 255 символов.',

            'password.required' => 'Введите пароль.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'password.max' => 'Пароль слишком длинный.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.regex' => 'Пароль должен содержать хотя бы одну букву и одну цифру.',
        ]);

        // Создание пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Авто-логин
        auth()->login($user);

        // Редирект на главную страницу
        return redirect()->route('main')->with('success', 'Регистрация прошла успешно!');
    }
}
