<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}">
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
<h1 class="bestsellers-title">НАШИ БЕСТСЕЛЛЕРЫ</h1>

<section class="product-row" data-el="div-1">
    <div class="product-grid">
        <article class="product-column">
            <div class="product-card">
                <h2 class="product-labels">МИРАЖ</h2>
                <img
                    src="{{ asset('img/best1.png') }}"
                    alt="Мираж букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-middle">
            <div class="product-card">
                <h2 class="product-labels">НЕЖНОСТЬ</h2>
                <img
                    src="{{ asset('img/best2.png') }}"
                    alt="Нежность букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-right">
            <div class="product-card">
                <h2 class="product-labels">ФЛАМИНГО</h2>
                <img
                    src="{{ asset('img/best3.png') }}"
                    alt="Фламинго букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>
    </div>
</section>

<section class="product-row" data-el="div-2">
    <div class="product-grid">
        <article class="product-column">
            <div class="product-card">
                <h2 class="product-labels">ЗЕФИР</h2>
                <img
                    src="{{ asset('img/best4.png') }}"
                    alt="Зефир букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-middle">
            <div class="product-card">
                <h2 class="product-labels">ОЧАРОВАНИЕ</h2>
                <img
                    src="{{ asset('img/best5.png') }}"
                    alt="Очарование букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-right">
            <div class="product-card">
                <h2 class="product-labels">КОМПЛИМЕНТ</h2>
                <img
                    src="{{ asset('img/best6.png') }}"
                    alt="Комплимент букет"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>
    </div>
</section>

<section class="product-row" data-el="div-3">
    <div class="product-grid">
        <article class="product-column">
            <div class="product-card">
                <h2 class="product-labels">ВАЗА</h2>
                <img
                    src="{{ asset('img/best7.png') }}"
                    alt="Ваза"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-middle">
            <div class="product-card">
                <h2 class="product-labels">ВАЗА</h2>
                <img
                    src="{{ asset('img/best8.png') }}"
                    alt="Ваза"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-right">
            <div class="product-card">
                <h2 class="product-labels">ВАЗА</h2>
                <img
                    src="{{ asset('img/best9.png') }}"
                    alt="Ваза"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>
    </div>
</section>

<section class="product-row" data-el="div-4">
    <div class="product-grid">
        <article class="product-column">
            <div class="product-card">
                <h2 class="product-labels">СВЕЧА ДЕКОРАТИВНАЯ</h2>
                <img
                    src="{{ asset('img/best10.png') }}"
                    alt="Свеча декоративная"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-middle">
            <div class="product-card">
                <h2 class="product-labels">СВЕЧА ДЕКОРАТИВНАЯ</h2>
                <img
                    src="{{ asset('img/best11.png') }}"
                    alt="Свеча декоративная"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>

        <article class="product-column-right">
            <div class="product-card">
                <h2 class="product-labels">СВЕЧА ДЕКОРАТИВНАЯ</h2>
                <img
                    src="{{ asset('img/best12.png') }}"
                    alt="Свеча декоративная"
                    class="product-image"
                />
                <p class="product-price">5900р</p>
                <button class="add-to-cart-btn">В КОРЗИНУ</button>
            </div>
        </article>
    </div>
</section>

<section class="cta-container">
    <div class="cta-content">
        <p class="cta-text">
            Будем рады обсудить Ваше предложение
            <br/>
            <br/>
            Если букеты которые есть в наличии вам неподходят, оставьте заявку и
            мы с вами свяжемся и сделаем индивидуальный букет для вас
        </p>
        <img
            src="{{ asset('img/love.png') }}"
            alt="Flower icon"
            class="cta-icon"
        />
        <button class="cta-button">Оставить заявку</button>
    </div>
</section>

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
