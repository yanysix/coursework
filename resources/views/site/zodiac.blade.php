
    <div class="container" style="max-width:700px;margin:40px auto;text-align:center;">

        <h1>Подбор цветов по знаку Зодиака</h1>
        <p class="proect">Введите вашу дату рождения, и мы подберём идеальные цветы и упаковку.</p>

        <form method="POST" action="{{ route('zodiac.select') }}" style="margin-top:30px;">
            @csrf
            <input type="date" name="birthday" required
                   style="padding:12px 18px;font-size:18px;border-radius:10px;border:1px solid #ccc;">
            <br><br>
            <button class="cta-button">Подобрать</button>
        </form>


    </div>
