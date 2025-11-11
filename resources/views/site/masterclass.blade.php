<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/masterclass.css') }}">
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

<section class="hero-section">
    <h1 class="page-title">Мастер классы</h1>
    <p class="page-subtitle">
        Влюбляем в цветы с особой нежностью и профессионализмом на наших
        флористических мастер-классах!
    </p>
</section>

<section class="info-section" data-el="div-1">
    <div class="info-container">
        <div class="info-column left-column">
            <div class="info-content">
                <p class="info-text">
                    Девичник, День Рождения, корпоративное мероприятие для Вашей
                    команды:<br> от Вас — повод, от нас — идея и реализация
                </p>
                <p class="info-text-bottom">
                    По окончанию мероприятия, все сделанные работы, а также инструменты
                    для работы с цветами, наши гости забирают с собой
                </p>
            </div>
        </div>
        <div class="info-column right-column">
            <div class="info-gallery" data-el="div-2">
                <div class="gallery-container">
                    <div class="gallery-image-column">
                        <img src="{{ asset('img/master1.png') }}"
                             alt="Flower arrangement workshop" class="gallery-image">
                    </div>
                    <div class="gallery-text-column">
                        <div class="gallery-text-content">
                            <p class="gallery-text">
                                Организуем мастер-класс как в нашей просторной цветочной
                                студии на Бумажном проезде, так и в выбранной Вами локации
                            </p>
                            <p class="gallery-text-bottom">
                                Дополнительно-приятные опции: винно-гастрономическое
                                сопровождение, фото и видео съемка
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-section" data-el="div-3">
    <div class="contact-container">
        <div class="contact-image-column">
            <img src="{{ asset('img/master2.png') }}"
                 alt="Flower arrangement" class="contact-image">
        </div>
        <div class="contact-form-column">
            <div class="contact-content">
                <img src="{{ asset('img/master3.png') }}"
                     alt="Flower arrangement" class="contact-decoration">
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
            </div>
        </div>
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
