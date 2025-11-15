<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/delivery.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<header>
    <div class="header">
        <nav class="nav-link">
            <a href="{{ route('decoration') }}">ЦВЕТОЧНОЕ ОФОРМЛЕНИЕ</a>
            <a href="{{ route('catalog') }}">КАТАЛОГ</a>
        </nav>

        <div class="header-logo">
            <a href="{{ route('main') }}"><img src="{{ asset('img/logo.png') }}" width="231" height="100" alt="logo"></a>
        </div>

        <nav class="nav-link">
            <a href="{{ route('delivery') }}">ДОСТАВКА</a>
            <a href="{{ route('masterclass') }}">МАСТЕР КЛАССЫ</a>
            <a href="#"><img src="{{ asset('img/bag.png') }}" class="bag" alt="bag"></a>

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
<main class="main">
    <div class="content">
        <h1>Доставка</h1>
        <div class="contact-detail">
            <div class="block">
                <p>Стандартная<br><br>
                    Букет будет доставлен в доступный трехчасовой интервал (500 рублей) или двухчасовой интервал<br>
                    (600 рублей) после согласования и оплаты
                </p>
            </div>
            <img loading="lazy" src="{{ asset('img/flower.png') }}" class="flower" alt="BLOSS flower"/>
            <div class="block">
                <p>
                    Экспресс<br><br>
                    Букет будет доставлен за 60 - 90 минут после согласования и оплаты - 1400 рублей
                </p>
            </div>
        </div>
        <div class="block-flower">
            <p class="text-flower">С вами на связи с 9.00 до 22.00<br>Доставка осуществляется с 9.00 до 22.00</p>
            <p class="text-flower">Доставку выполняем в день заказа, либо к определенной дате<br> по предварительному
                согласованию.<br>
                Для бережной транспортировки мы упаковываем букеты в брендированные<br> коробки, прикладываем инструкцию
                по уходу и смесь для подкормки цветов.<br>
                Доставку доверяем только курьерам, проверенным на пунктуальность,<br> тактичность и аккуратность.</p>
            <p class="text-flower-main">Цветут цветы - Цвети и ты!</p>
        </div>

    </div>
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
