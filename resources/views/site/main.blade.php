<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<!-- HEADER -->
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
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/profile.png') }}"
                    class="bag profile-icon"
                    alt="profile"
                    id="navAvatar">

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

<!-- MAIN -->
<main class="main">
    <div class="container">
        <h1 class="main_title">Цветы и декор в стиле BLOSS</h1>
        <p class="main_text">Свежие цветы, авторское оформление пространства. Актуальный декор и предметы интерьера.</p>
        <button class="main_button">Перейти в каталог</button>
    </div>
    <div class="container_img">
        <img src="{{ asset('img/image 2.png') }}" class="image2" alt="image2">
        <img src="{{ asset('img/image 3.png') }}" class="image3" alt="image3">
        <img src="{{ asset('img/image1.png') }}" class="image1" alt="image1">
    </div>
</main>

<!-- ОСТАЛЬНЫЙ КОНТЕНТ -->
<div class="container_img1">
    <img src="{{ asset('img/image 4.png') }}" class="image4" alt="image4">
    <img src="{{ asset('img/image 5.png') }}" class="image5" alt="image5">
    <img src="{{ asset('img/image 6.png') }}" class="image6" alt="image6">
    <img src="{{ asset('img/image 7.png') }}" class="image7" alt="image7">
</div>

<div class="container1">
    <h1 class="comand">КОМАНДА</h1>
    <p class="comand1">которая работает над созданием вашего букета состоит из профессионалов с многолетним опытом</p>

    <h1 class="mood">НАСТРОЕНИЯ</h1>
    <p class="mood1">создают свежие, гармоничные букеты цветов, в которые мы всегда добавляем</p>

    <h1 class="love">ЛЮБОВЬ</h1>
    <p class="love1">с каждым цветком</p>

    <div class="ellipse"></div>
</div>

<div class="container_img2">
    <img src="{{ asset('img/image 8.png') }}" class="image8" alt="image8">
    <img src="{{ asset('img/image 9.png') }}" class="image9" alt="image9">
    <img src="{{ asset('img/image 10.png') }}" class="image10" alt="image10">
</div>

<div class="container2">
    <h1 class="WE">МЫ</h1>
    <p class="WE1">Каждый день собираем работаем, чтобы Вы очаровывались и очаровывали. Ваш восторг в будущем – наше вдохновение в настоящем.</p>

    <div class="container3">
        <p class="proect">Будем рады обсудить Ваш проект.<br><br> Оставьте свои контактные данные, и мы свяжемся c Вами в ближайшее время</p>
        <button class="buttons">Оставить заявку</button>
    </div>
</div>

<!-- FOOTER -->
<footer class="container7">
    <div class="container8">
        <div class="logo-contact-column">
            <div class="logo-contact-wrapper">
                <div class="logo-wrapper">
                    <img src="{{ asset('img/footer.png') }}" class="logo" alt="BLOSS logo"/>
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

<script src="{{ asset('js/modal.js') }}"></script>

</body>
</html>
