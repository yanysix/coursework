
<div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <h2 class="modal-title">Регистрация</h2>
        <p class="modal-subtitle">Создайте аккаунт, чтобы оформить заказы и участвовать в мастер-классах</p>

        <form method="POST" action="{{ route('register') }}" class="modal-form">
            @csrf

            <label for="name">Имя</label>
            <input type="text" id="name" name="name" placeholder="Ваше имя" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="example@mail.ru" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль" required>

            <label for="password_confirmation">Подтвердите пароль</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль" required>

            <button type="submit" class="main_button modal-btn">Зарегистрироваться</button>

            <p class="modal-bottom-text">
                Уже есть аккаунт?
                <a href="#" class="modal-link" id="openLogin">Войти</a>
            </p>
        </form>
    </div>
</div>
