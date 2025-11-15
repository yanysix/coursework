<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход — BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">
    <h2>Вход</h2>
    <p>Введите email и пароль для входа</p>

    @if(session('error'))
        <p class="error-message">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('auth.login') }}" class="auth-form">
        @csrf

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

        <button type="submit" class="modal-btn">Войти</button>
    </form>

    <p class="modal-bottom-text">
        Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
    </p>
</div>

<script src="{{ asset('js/modals.js') }}"></script>

</body>
</html>
