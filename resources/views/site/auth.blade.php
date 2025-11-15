<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <h2 class="modal-title">Вход в аккаунт</h2>
        <p class="modal-subtitle">Введите ваши данные, чтобы войти</p>

        <form method="POST" action="{{ route('login') }}" class="modal-form">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="example@mail.ru" required>

            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Введите пароль" required>

            <button type="submit" class="main_button modal-btn">Войти</button>

            <p class="modal-bottom-text">
                Нет аккаунта?
                <a href="{{ route('register') }}" class="modal-link">Зарегистрироваться</a>
            </p>
        </form>
    </div>
</div>
