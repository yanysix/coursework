<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<header>
    <div class="header">
        <nav class="nav-link">
            <a href="{{ route('decoration') }}">ЦВЕТОЧНОЕ ОФОРМЛЕНИЕ</a>
            <a href="{{ route('flower') }}">ЦВЕТЫ</a>
        </nav>

        <div class="header-logo">
            <a href="{{ route('main') }}"><img src="{{ asset('img/logo.png') }}" width="231" height="100" alt="logo"></a>
        </div>

        <nav class="nav-link">
            <a href="{{ route('packaging') }}">УПАКОВКИ</a>
            <a href="{{ route('bouquets') }}">БУКЕТЫ</a>
            <a href="{{ route('cart') }}"><img src="{{ asset('img/bag.png') }}" class="bag" alt="Корзина"></a>

            <div class="profile-dropdown">
                <img
                    src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/profile.png') }}"
                    class="bag profile-icon"
                    alt="profile">
                <div class="dropdown-content">
                    @guest
                        <a href="{{ route('auth') }}">Войти</a>
                        <a href="{{ route('register') }}">Зарегистрироваться</a>
                    @else
                        <a href="{{ route('profile') }}">Профиль</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-link">Выйти</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</header>

<div class="settings-container">
    <h2 class="settings-title">Настройки профиля</h2>

    @if(session('success_info'))
        <p class="success-message">{{ session('success_info') }}</p>
    @endif

    <div class="settings-block">
        <h3>Аватар</h3>
        <div class="avatar-preview-wrapper">
            <img
                id="avatarPreview"
                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/profile.png') }}"
                alt="Аватар пользователя"
                class="avatar-preview">
        </div>

        <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
            @csrf
            <div class="settings-row">
                <label class="settings-label">Выберите файл</label>
                <input type="file" name="avatar" class="settings-input" accept="image/*" id="avatarInput">
                @error('avatar') <p class="error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="save-btn">Загрузить аватар</button>
        </form>
    </div>

    <div class="settings-block">
        <h3>Личная информация</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="settings-row">
                <label class="settings-label">Имя</label>
                <input type="text" name="name" class="settings-input" value="{{ $user->name }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="settings-row">
                <label class="settings-label">Email</label>
                <input type="email" name="email" class="settings-input" value="{{ $user->email }}" required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" name="update_info" class="save-btn">Сохранить изменения</button>
        </form>
    </div>

    <hr class="divider">

    @if(session('success_password'))
        <p class="success-message">{{ session('success_password') }}</p>
    @endif
    <div class="settings-block">
        <h3>Смена пароля</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <div class="settings-row">
                <label class="settings-label">Новый пароль</label>
                <input type="password" name="password" class="settings-input" required>
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>
            <div class="settings-row">
                <label class="settings-label">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" class="settings-input" required>
            </div>
            <button type="submit" name="update_password" class="save-btn">Обновить пароль</button>
        </form>
    </div>

    <div class="settings-block">
        <h3>Удаление аккаунта</h3>
        <p class="warning-text">
            Ваш аккаунт и все связанные данные будут удалены навсегда.
            Это действие <b>не может быть отменено</b>.
        </p>
        <form method="POST" action="{{ route('profile.delete') }}">
            @csrf
            @method('DELETE')
            <div class="settings-row">
                <label class="settings-label">Введите пароль для подтверждения</label>
                <input type="password" name="password" class="settings-input" placeholder="Ваш пароль" required>
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="save-btn delete-btn">Удалить аккаунт</button>
        </form>
    </div>

    <a href="{{ route('profile') }}" class="back-link">Назад в профиль</a>
</div>

<footer class="container7">
    <div class="container8">
        <div class="logo-contact-column">
            <div class="logo-contact-wrapper">
                <div class="logo-wrapper">
                    <img loading="lazy" src="{{ asset('img/footer.png') }}" class="logo" alt="BLOSS logo"/>
                </div>
                <div class="contact-info">
                    <h2 class="brand-name">BLOSS</h2>
                    <p class="contact-details">
                        Контакты<br/>
                        +7(913) 811 09 09<br/>
                        Томск, Ленина 52а<br/>
                        Copyright ©2024 BLOSS
                    </p>
                </div>
            </div>
        </div>
        <div class="navigation-form-column">
            <div class="navigation-form-wrapper">
                <nav class="navigation">
                    <ul class="nav-links">
                        <li>Цветочное оформление</li>
                        <li>Мы</li>
                        <li>Доставка</li>
                        <li>Мастер классы</li>
                        <li>Личный кабинет</li>
                    </ul>
                </nav>
                <div class="form-wrapper">
                    <form class="form-content">
                        <p class="form-description">
                            Не знаете что заказать? Закажите звонок!<br/>
                            Мы поможем Вам с выбором
                        </p>
                        <label for="phone" class="visually-hidden"></label>
                        <input type="tel" id="phone" class="form-input" placeholder="Ваш телефон"
                               aria-label="Ваш телефон"/>
                        <label for="name" class="visually-hidden"></label>
                        <input type="text" id="name" class="form-input" placeholder="Ваше имя" aria-label="Ваше имя"/>
                        <button type="submit" class="button1">Оставить заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/avatar.js') }}"></script>

</body>
</html>
