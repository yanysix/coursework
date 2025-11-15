<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="auth-container">
    <h2>Регистрация</h2>
    <p>Создайте аккаунт, чтобы оформить заказы и участвовать в мастер-классах</p>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" class="auth-form">
        @csrf

        <label for="name">Имя</label>
        <input type="text" id="name" name="name" placeholder="Ваше имя" required value="{{ old('name') }}">
        @error('name')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="example@mail.ru" required value="{{ old('email') }}">
        @error('email')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Введите пароль" required>
        @error('password')
        <p class="error">{{ $message }}</p>
        @enderror

        <label for="password_confirmation">Подтвердите пароль</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль" required>

        <button type="submit" class="modal-btn">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="{{ route('auth') }}">Войти</a></p>
</div>

<script src="{{ asset('js/modal.js') }}"></script>


</body>
</html>
