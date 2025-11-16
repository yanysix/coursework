{{--<!DOCTYPE html>--}}
{{--<html lang="ru">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Обертки для цветов | BLOSS</title>--}}
{{--    <link rel="stylesheet" href="{{ asset('css/packaging.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('css/main.css') }}">--}}
{{--</head>--}}
{{--<body>--}}
{{--<header>--}}
{{--    <div class="header">--}}
{{--        <nav class="nav-link">--}}
{{--            <a href="{{ route('decoration') }}">ЦВЕТОЧНОЕ ОФОРМЛЕНИЕ</a>--}}
{{--            <a href="{{ route('flower') }}">ЦВЕТЫ</a>--}}
{{--        </nav>--}}

{{--        <div class="header-logo">--}}
{{--            <a href="{{ route('main') }}"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>--}}
{{--        </div>--}}

{{--        <nav class="nav-link">--}}
{{--            <a href="{{ route('packaging') }}">УПАКОВКИ</a>--}}
{{--            <a href="{{ route('masterclass') }}">МАСТЕР КЛАССЫ</a>--}}
{{--            <div class="profile-dropdown">--}}
{{--                <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/profile.png') }}"--}}
{{--                     class="profile-icon" alt="profile">--}}
{{--                <div class="dropdown-content">--}}
{{--                    @guest--}}
{{--                        <a href="{{ route('auth') }}">Войти</a>--}}
{{--                        <a href="{{ route('register') }}">Зарегистрироваться</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('profile') }}">Профиль</a>--}}
{{--                        <form method="POST" action="{{ route('logout') }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit" class="logout-link">Выйти</button>--}}
{{--                        </form>--}}
{{--                    @endguest--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<main class="main">--}}
{{--    <section class="hero-packaging">--}}
{{--        <h1>Создайте свою уникальную обертку для цветов</h1>--}}
{{--        <p>Выберите материал, цвет и декор — мы поможем вам оформить идеальный букет.</p>--}}
{{--        <button class="cta-button" id="open-packaging-form">Сделать свою обертку</button>--}}
{{--    </section>--}}

{{--    <section class="packaging-gallery">--}}
{{--        <h2>Наши готовые решения</h2>--}}
{{--        <div class="gallery-grid">--}}
{{--            <p>Оберток пока нет. Скоро появятся наши уникальные дизайны!</p>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="custom-packaging-form" id="custom-packaging-form">--}}
{{--        <h2>Создайте свою обертку</h2>--}}

{{--        <form method="POST" action="{{ route('packaging.custom') }}" enctype="multipart/form-data">--}}
{{--            @csrf--}}

{{--            <div class="form-group">--}}
{{--                <label for="material">Материал:</label>--}}
{{--                <input type="text" id="material" name="material" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="color">Цвет:</label>--}}
{{--                <input type="text" id="color" name="color" required>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="decor">Декор:</label>--}}
{{--                <input type="text" id="decor" name="decor">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="image">Фото/Пример:</label>--}}
{{--                <input type="file" id="image" name="image" accept="image/*" class="file-input">--}}
{{--            </div>--}}

{{--            <button type="submit" class="cta-button submit-btn">Отправить заявку</button>--}}
{{--        </form>--}}
{{--    </section>--}}


{{--</main>--}}

{{--<footer class="container7">--}}
{{--    <div class="container8">--}}
{{--        <div class="logo-contact-column">--}}
{{--            <div class="logo-contact-wrapper">--}}
{{--                <div class="logo-wrapper">--}}
{{--                    <img loading="lazy" src="{{ asset('img/footer.png') }}" class="logo" alt="BLOSS logo"/>--}}
{{--                </div>--}}
{{--                <div class="contact-info">--}}
{{--                    <h2 class="brand-name">BLOSS</h2>--}}
{{--                    <p class="contact-details">--}}
{{--                        Контакты<br/>--}}
{{--                        +7(913) 811 09 09<br/>--}}
{{--                        Томск, Ленина 52а<br/>--}}
{{--                        Copyright ©2024 BLOSS--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="navigation-form-column">--}}
{{--            <div class="navigation-form-wrapper">--}}
{{--                <nav class="navigation">--}}
{{--                    <ul class="nav-links">--}}
{{--                        <li>Цветочное оформление</li>--}}
{{--                        <li>Мы</li>--}}
{{--                        <li>Доставка</li>--}}
{{--                        <li>Мастер классы</li>--}}
{{--                        <li>Личный кабинет</li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
{{--                <div class="form-wrapper">--}}
{{--                    <form class="form-content">--}}
{{--                        <p class="form-description">--}}
{{--                            Не знаете что заказать? Закажите звонок!<br/>--}}
{{--                            Мы поможем Вам с выбором--}}
{{--                        </p>--}}
{{--                        <label for="phone" class="visually-hidden"></label>--}}
{{--                        <input type="tel" id="phone" class="form-input" placeholder="Ваш телефон"--}}
{{--                               aria-label="Ваш телефон"/>--}}
{{--                        <label for="name" class="visually-hidden"></label>--}}
{{--                        <input type="text" id="name" class="form-input" placeholder="Ваше имя" aria-label="Ваше имя"/>--}}
{{--                        <button type="submit" class="button1">Оставить заявку</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}

{{--</body>--}}
{{--</html>--}}
