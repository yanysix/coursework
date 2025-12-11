<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | BLOSS</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zodiac.css') }}">
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

<div class="zodiac-container">

    <h1 class="zodiac-title">Подбор цветов по знаку Зодиака</h1>
    <p class="zodiac-subtitle">
        Введите вашу дату рождения, и мы подберём идеальные цветы и упаковку.
    </p>

    <form method="POST" action="{{ route('zodiac.select') }}" class="zodiac-form">
        @csrf

        <input type="date" name="birthday" class="zodiac-input" required>

        <button class="zodiac-button">Подобрать</button>
    </form>

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
