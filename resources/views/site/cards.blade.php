<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Открытки | BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
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
            <a href="{{ route('main') }}"><img src="{{ asset('img/logo.png') }}" alt="logo"></a>
        </div>

        <nav class="nav-link">
            <a href="{{ route('packaging') }}">УПАКОВКИ</a>
            <a href="{{ route('bouquets') }}">БУКЕТЫ</a>
            <a href="{{ route('cart') }}"><img src="{{ asset('img/bag.png') }}" class="bag" alt="Корзина"></a>
            <div class="profile-dropdown">
                <img src="{{ Auth::check() && Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/profile.png') }}"
                     class="bag profile-icon" alt="profile">
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

<main class="main1">
    <section class="hero-packaging">
        <h1>Создайте свою уникальную открытку для цветов</h1>
        <p>Выберите материал, цвет и декор — мы поможем вам оформить идеальный букет.</p>
        <button class="cta-button" id="open-packaging-form">Сделать свою открытку</button>
    </section>

    <section class="custom-packaging-form" id="custom-packaging-form">
        <span class="close-form" id="close-form">&times;</span>
        <h2>Создайте свою открытку</h2>
        <form method="POST" action="{{ route('cards.createPdf') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Название открытки:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="message">Текст открытки:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="color">Цвет оформления фона (необязательно):</label>
                <input type="color" id="color" name="color" value="#ffcc00">
            </div>

            <div class="form-group">
                <label for="image">Фото (необязательно):</label>
                <input type="file" id="image" name="image" accept="image/*" class="file-input">
            </div>

            <button type="submit" class="cta-button submit-btn">Создать и скачать PDF</button>
        </form>
    </section>

    <section class="my-cards">
        <h2>Мои открытки</h2>
        <div class="gallery-grid">
            @forelse($cards as $card)
                <div class="card-item fancy-card">
                    <h3>{{ $card->title }}</h3>
                    <p>{{ $card->message }}</p>
                    <a href="{{ route('cards.download', $card->public_token) }}" class="cta-button">Скачать PDF</a>
                    <p class="created-at">Создано: {{ $card->created_at->format('d.m.Y H:i') }}</p>
                </div>

            @empty
                <p>Вы еще не создали ни одной открытки.</p>
            @endforelse
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
                        <input type="tel" class="form-input" placeholder="Ваш телефон"/>
                        <input type="text" class="form-input" placeholder="Ваше имя"/>
                        <button type="submit" class="button1">Оставить заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/cards.js') }}"></script>

</body>
</html>
