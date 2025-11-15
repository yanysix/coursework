<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | BLOSS</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<header>
    <div class="header">
        <nav class="nav-link">
            <a href="{{ route('decoration') }}">ЦВЕТОЧНОЕ ОФОРМЛЕНИЕ</a>
            <a href="{{ route('catalog') }}">КАТАЛОГ</a>
        </nav>
        <div class="header-logo">
            <a href="{{ route('main') }}"><img src="{{ asset('img/logo.png') }}" width="231" height="100px" alt="logo"></a>
        </div>

        <nav class="nav-link">
            <a href="{{ route('delivery') }}">ДОСТАВКА</a>
            <a href="{{ route('masterclass') }}">МАСТЕР КЛАССЫ</a>

            <a href="#"><img src="{{ asset('img/bag.png') }}" class="bag"></a>
            <a href="#"><img src="{{ asset('img/profile.png') }}" class="bag"></a>

        </nav>
    </div>
</header>

<main class="profile-page">
    <section class="profile-header">
        <div class="avatar-wrapper">
            <img src="{{ asset('img/profile.png') }}" alt="Аватар пользователя">
        </div>
        <div class="profile-info">
            <h1>{{ Auth::user()->name ?? 'Имя пользователя' }}</h1>
            <p>{{ Auth::user()->email ?? 'email@example.com' }}</p>
        </div>
    </section>

    <section class="profile-actions">
        <button class="btn edit-btn">Редактировать профиль</button>

        {{-- <form method="POST" action="{{ route('logout') }}"> --}}
        @csrf
        <button type="submit" class="btn logout-btn">Выйти</button>
        </form>
    </section>

    <section class="orders-section">
        <h2>Ваши заказы</h2>
        <p>Здесь вы можете просмотреть свои предыдущие покупки</p>

        <div class="orders-list">
            <div class="order-card">
                <img src="{{ asset('img/image 13.png') }}" alt="Букет">
                <div class="order-info">
                    <h3>Букет “Розовая нежность”</h3>
                    <p class="date">от 12.10.2025</p>
                    <button class="btn small-btn">Подробнее</button>
                </div>
            </div>

            <div class="order-card">
                <img src="{{ asset('img/image 14.png') }}" alt="Букет">
                <div class="order-info">
                    <h3>Букет “Осенний блюз”</h3>
                    <p class="date">от 25.09.2025</p>
                    <button class="btn small-btn">Подробнее</button>
                </div>
            </div>
        </div>
    </section>
</main>

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
</body>
</html>
