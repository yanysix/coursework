<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | BLOSS</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zodiac-result.css') }}">
</head>
<body>
<!-- HEADER -->
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
            <a href="{{ route('masterclass') }}">МАСТЕР КЛАССЫ</a>
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
<div class="zodiac-result-container">

    <h1>Ваш знак Зодиака:
        <span class="zodiac-sign">{{ $sign }}</span>
    </h1>

    <div class="zodiac-result-cards">

        <!-- Блок цветка -->
        <div class="zodiac-card">
            <h2>Идеальный цветок</h2>

            @if($flower->image)
                <img src="{{ asset('storage/' . $flower->image) }}" class="zodiac-image">
            @endif

            <h3>{{ $flower->name }}</h3>
            <p class="price">Цена: {{ $flower->price }} ₽</p>

            @auth
                <form action="{{ route('cart.flower.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                    <input type="hidden" name="price" value="{{ $flower->price }}">
                    <button class="cta-button">Добавить в корзину</button>
                </form>
            @else
                <a href="{{ route('auth') }}" class="cta-button" style="background:#bbb;">
                    Войдите, чтобы добавить
                </a>
            @endauth
        </div>

        <!-- Блок упаковки -->
        <div class="zodiac-card">
            <h2>Идеальная упаковка</h2>

            @if($packaging->image)
                <img src="{{ asset('storage/' . $packaging->image) }}" class="zodiac-image">
            @endif

            <h3>{{ $packaging->name }}</h3>
            <p class="price">Цена: {{ $packaging->price }} ₽</p>

            <form action="{{ route('cart.packaging.add') }}" method="POST">
                @csrf
                <input type="hidden" name="packaging_id" value="{{ $packaging->id }}">
                <input type="hidden" name="price" value="{{ $packaging->price }}">
                @auth
                    <button class="cta-button">Добавить в корзину</button>
                @else
                    <a href="{{ route('auth') }}" class="cta-button" style="background:#bbb;">
                        Войдите, чтобы добавить
                    </a>
                @endauth
            </form>
        </div>

    </div>

    <div class="zodiac-back">
        <a href="{{ route('zodiac.index') }}" class="cta-button back-btn">Выбрать дату заново</a>
    </div>

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
