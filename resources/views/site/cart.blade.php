<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина | BLOSS</title>
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>

<header>
    <div class="header">
        @if(session('success'))
            <div class="flash-message">
                <span class="flash-icon">✔</span>
                <span class="flash-text">{{ session('success') }}</span>
                <span class="flash-close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif
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

<main class="main-cart">
    <h1>Ваша корзина</h1>

    <div class="cart-container">
        @if($cartItemsFlowers->count())
            <h2>Цветы</h2>
            @foreach($cartItemsFlowers as $item)
                <div class="cart-item">
                    <img src="{{ $item->flower->image ? asset('storage/' . $item->flower->image) : asset('img/placeholder.png') }}"
                         alt="{{ $item->flower->name }}">

                    <div class="item-info">
                        <h3>{{ $item->flower->name }}</h3>
                        <p class="price">Цена: {{ $item->price }} ₽</p>
                    </div>

                    <div class="quantity-control">
                        <form method="POST" action="{{ route('cart.updateCount', ['type' => 'flower', 'id' => $item->id]) }}">
                            @csrf
                            <input type="hidden" name="action" value="decrement">
                            <button type="submit">-</button>
                        </form>

                        <span>{{ $item->count }}</span>

                        <form method="POST" action="{{ route('cart.updateCount', ['type' => 'flower', 'id' => $item->id]) }}">
                            @csrf
                            <input type="hidden" name="action" value="increment">
                            <button type="submit">+</button>
                        </form>
                    </div>

                    <form method="POST" action="{{ route('cart.remove', ['type' => 'flower', 'id' => $item->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="remove-btn">Удалить</button>
                    </form>
                </div>
            @endforeach
        @endif

        @if($cartItemsPackagings->count())
                <h2>Упаковки</h2>
                @foreach($cartItemsPackagings as $item)
                    <div class="cart-item">
                        <img src="{{ $item->packaging->image ? asset('storage/' . $item->packaging->image) : asset('img/placeholder.png') }}"
                             alt="{{ $item->packaging->name }}">

                        <div class="item-info">
                            <h3>{{ $item->packaging->name }}</h3>
                            <p class="price">Цена: {{ $item->price }} ₽</p>
                        </div>

                        <div class="quantity-control">
                            <form method="POST" action="{{ route('cart.updateCount', ['type' => 'packaging', 'id' => $item->id]) }}">
                                @csrf
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit">-</button>
                            </form>

                            <span>{{ $item->count }}</span>

                            <form method="POST" action="{{ route('cart.updateCount', ['type' => 'packaging', 'id' => $item->id]) }}">
                                @csrf
                                <input type="hidden" name="action" value="increment">
                                <button type="submit">+</button>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('cart.remove', ['type' => 'packaging', 'id' => $item->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="remove-btn">Удалить</button>
                        </form>
                    </div>
                @endforeach
            @endif

            @if($cartItemsBouquets->count())
                <h2>Букеты</h2>
                @foreach($cartItemsBouquets as $item)
                    <div class="cart-item">
                        <img src="{{ $item->bouquet->image ? asset('storage/' . $item->bouquet->image) : asset('img/placeholder.png') }}"
                             alt="{{ $item->bouquet->name }}">

                        <div class="item-info">
                            <h3>{{ $item->bouquet->name }}</h3>
                            <p class="price">Цена: {{ $item->price }} ₽</p>
                        </div>
                        <div class="quantity-control">
                            <form method="POST" action="{{ route('cart.updateCount', ['type' => 'bouquet', 'id' => $item->id]) }}">
                                @csrf
                                <input type="hidden" name="action" value="decrement">
                                <button type="submit">-</button>
                            </form>

                            <span>{{ $item->count }}</span>

                            <form method="POST" action="{{ route('cart.updateCount', ['type' => 'bouquet', 'id' => $item->id]) }}">
                                @csrf
                                <input type="hidden" name="action" value="increment">
                                <button type="submit">+</button>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('cart.remove', ['type' => 'bouquet', 'id' => $item->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button class="remove-btn">Удалить</button>
                        </form>
                    </div>
                @endforeach
            @endif


        @if(!$cartItemsFlowers->count() && !$cartItemsPackagings->count())
            <p>Ваша корзина пуста.</p>
        @endif
    </div>

    @if($total > 0)
        <div class="cart-footer">
            <p class="total">Итого: {{ $total }} ₽</p>
            <a href="#" class="cta-button">Оформить заказ</a>
        </div>
    @endif
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
    </div>
</footer>

</body>
</html>
