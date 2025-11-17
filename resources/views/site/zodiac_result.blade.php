
    <div class="container" style="max-width:1100px;margin:40px auto;">
        <h1>Ваш знак Зодиака: <span style="color:#dd4f69">{{ $sign }}</span></h1>

        <div style="display:flex;gap:30px;flex-wrap:wrap;margin-top:30px;">

            <!-- Цветок -->
            <div style="flex:1;min-width:300px;background:#fff;padding:20px;border-radius:12px;
            box-shadow:0 8px 30px rgba(0,0,0,0.06);">
                <h2>Идеальный цветок</h2>
                @if($flower->image)
                    <img src="{{ asset('storage/' . $flower->image) }}"
                         style="width:100%;height:230px;object-fit:cover;border-radius:10px;margin-bottom:10px;">
                @endif
                <h3>{{ $flower->name }}</h3>
                <p>Цена: {{ $flower->price }} ₽</p>

                <form action="{{ route('cart.flower.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="flower_id" value="{{ $flower->id }}">
                    <input type="hidden" name="price" value="{{ $flower->price }}">
                    <button class="cta-button">Добавить в корзину</button>
                </form>

            </div>

            <!-- Упаковка -->
            <div style="flex:1;min-width:300px;background:#fff;padding:20px;border-radius:12px;
            box-shadow:0 8px 30px rgba(0,0,0,0.06);">
                <h2>Идеальная упаковка</h2>
                @if($packaging->image)
                    <img src="{{ asset('storage/' . $packaging->image) }}"
                         style="width:100%;height:230px;object-fit:cover;border-radius:10px;margin-bottom:10px;">
                @endif
                <h3>{{ $packaging->name }}</h3>
                <p>Цена: {{ $packaging->price }} ₽</p>

                <form action="{{ route('cart.packaging.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="packaging_id" value="{{ $packaging->id }}">
                    <input type="hidden" name="price" value="{{ $packaging->price }}">
                    <button class="cta-button">Добавить в корзину</button>
                </form>

            </div>

        </div>

        <div style="margin-top:30px;">
            <a href="{{ route('zodiac.index') }}" class="cta-button"
               style="background:#fff;border:2px solid #dd4f69;color:#dd4f69;">
                Выбрать дату заново
            </a>
        </div>
    </div>

