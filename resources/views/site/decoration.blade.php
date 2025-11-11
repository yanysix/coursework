<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/decoration.css') }}">
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

<main id="main-content">

    <section class="hero" aria-labelledby="hero-title">
        <div class="hero-content">
            <img src="{{ asset('img/of1.png') }}"
                 class="left-img" alt="Лучшие цветочные композиции от BLOSS" width="800" height="400">
            <h1 id="hero-title">Лучшее что может быть от BLOSS</h1>
        </div>
        <div class="hero-content">
            <h2>Оформление<br> праздничных пространств</h2>
            <img src="{{ asset('img/of2.png') }}"
                 class="right-img" alt="Праздничное оформление пространства" width="800" height="400">
        </div>
    </section>


    <section class="collaboration" aria-labelledby="collaboration-title">
        <h2 id="collaboration-title">ВАРИАНТЫ СОТРУДНИЧЕСТВА</h2>
        <div class="collaboration-flex">
            <div class="collaboration-item">
                <div>
                    <h3>Свадьбы, дни рождения, корпоративы</h3>
                    <img src="{{ asset('img/of3.png') }}"
                         alt="Оформление для свадеб и корпоративов" width="162" height="162">
                </div>
                <div>
                    <h3>Конференции, выставки, открытия</h3>
                    <img src="{{ asset('img/of4.png') }}"
                         alt="Оформление для конференций и выставок" width="150" height="150">
                </div>
            </div>
            <div class="portfolio">
                <p class="collaboration-description">Посмотрите наше портфолио и убедитесь, что нам, вы точно можете
                    доверить свой праздник</p>
                <a href="#" class="portfolio-button">ПОРТФОЛИО</a>
            </div>
            <div class="collaboration-item">
                <div>
                    <h3>Фестивали и городские праздники</h3>
                    <img src="{{ asset('img/of5.png') }}"
                         alt="Оформление для фестивалей" width="150" height="150">
                </div>
                <div>
                    <h3>Декорирование фото и видео-зон</h3>
                    <img src="{{ asset('img/of6.png') }}"
                         alt="Декорирование фото и видео-зон" width="150" height="150">
                </div>
            </div>
        </div>
    </section>

    <div class="divider" role="presentation"></div>

    <section class="wedding-decor" aria-labelledby="wedding-decor-title">
        <h2 id="wedding-decor-title">Свадебное декорирование</h2>
        <p>Мы знаем, как подчеркнуть индивидуальность свадьбы каждой влюбленной пары. Созданные нами декор и флористика
            привнесут в ваше событие особенную романтическую атмосферу</p>
        <img src="{{ asset('img/of7.png') }}"
             alt="Пример свадебного декора" width="1600" height="800">
    </section>

    <div class="divider" role="presentation"></div>

    <section class="corporate-events" aria-labelledby="corporate-events-title">
        <h2 id="corporate-events-title">Создание индивидуальных букетов для корпоративных праздников<br>Оформление офисов и мероприятий</h2>
        <p>Мотивация ваших сотрудников напрямую зависит от того, в какой обстановке они находятся –и не важно в офисе
            или на корпоративе, мы создадим лучшую атмосферу. Букеты в стиле вашей компании под любой бюджет и
            запрос</p>
        <img src="{{ asset('img/of8.png') }}"
             alt="Корпоративное оформление" width="1600" height="800">
    </section>

    <div class="contact-form-wrapper">
        <div class="contact-form-content">
            <p class="contact-text">
                Будем рады обсудить Ваш проект
                <br><br>
                Оставьте свои контактные данные, и мы свяжемся с Вами
                в ближайшее время
            </p>
            <button class="cta-button">Оставить заявку</button>
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
