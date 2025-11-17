<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/flower.css') }}">
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
            <a href="{{ route('main') }}">
                <img src="{{ asset('img/logo.png') }}" width="231" height="100" alt="logo">
            </a>
        </div>

        <nav class="nav-link">
            <a href="{{ route('packaging') }}">УПАКОВКИ</a>
            <a href="{{ route('masterclass') }}">МАСТЕР КЛАССЫ</a>
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
    <section class="flowers-section">
        <h2>Наши цветы</h2>

        <!-- Форма поиска и фильтрации -->
        <form method="GET" action="{{ route('flower') }}" class="filter-form">
            <input type="text" name="search" placeholder="Поиск по названию" value="{{ request('search') }}">
            <input type="number" name="min_price" placeholder="Мин. цена" value="{{ request('min_price') }}">
            <input type="number" name="max_price" placeholder="Макс. цена" value="{{ request('max_price') }}">
            <button type="submit" class="cta-button">Применить</button>
            <a href="{{ route('flower') }}" class="cta-button reset-button">Сбросить</a>
        </form>

        <div class="gallery-grid">
            @forelse($flowers as $flower)
                <div class="card-item">
                    @if($flower->image)
                        <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="flower-image">
                    @else
                        <img src="{{ asset('img/placeholder.png') }}" alt="Нет изображения" class="flower-image">
                    @endif
                    <h3>{{ $flower->name }}</h3>
                    @if($flower->price)
                        <p class="price">Цена: {{ $flower->price }} ₽</p>
                    @endif
                    <form method="POST" action="{{ route('cart.flower.add') }}">
                        @csrf
                        <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                        <input type="hidden" name="price" value="{{ $flower->price }}">
                        <button type="submit" class="cta-button">Добавить в корзину</button>
                    </form>
                </div>
            @empty
                <p>Цветов пока нет.</p>
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

</body>
</html>
