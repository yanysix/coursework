@extends('adminpanel.layouts.app')

@section('title', 'Упаковки')

@section('content')
    <div class="admin-actions">
        <button id="show-add-packaging" class="btn btn-primary">Добавить упаковку</button>
    </div>

    <div id="packaging-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title">Добавить упаковку</h2>

            <div id="current-image" style="margin-bottom:10px;"></div>

            <form id="packaging-form" method="POST" enctype="multipart/form-data"
                  data-store-url="{{ route('admin.packaging.store') }}">

                @csrf
                <input type="hidden" id="packaging-id" name="packaging_id">

                <div class="form-group">
                    <label for="name">Название упаковки</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price">Цена (₽)</label>
                    <input type="number" step="0.01" id="price" name="price">
                </div>

                <div class="form-group">
                    <label for="zodiac_sign">Знак зодиака (необязательно)</label>
                    <select id="zodiac_sign" name="zodiac_sign">
                        <option value="">— Без привязки —</option>
                        <option value="Овен">Овен</option>
                        <option value="Телец">Телец</option>
                        <option value="Близнецы">Близнецы</option>
                        <option value="Рак">Рак</option>
                        <option value="Лев">Лев</option>
                        <option value="Дева">Дева</option>
                        <option value="Весы">Весы</option>
                        <option value="Скорпион">Скорпион</option>
                        <option value="Стрелец">Стрелец</option>
                        <option value="Козерог">Козерог</option>
                        <option value="Водолей">Водолей</option>
                        <option value="Рыбы">Рыбы</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Изображение</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <button type="submit" class="btn btn-success" id="save-packaging">Сохранить</button>
            </form>
        </div>
    </div>

    <div class="cards-container">
        @forelse($packagings as $package)
            <div class="card" data-id="{{ $package->id }}">
                <h3>{{ $package->name }}</h3>

                @if($package->image)
                    <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="flower-image">
                @endif
                <p>Знак: {{ $package->zodiac_sign ?? '—' }}</p>
                <p class="price">{{ $package->price ? $package->price.' ₽' : '-' }}</p>

                <div class="card-actions">
                    <button class="btn btn-warning edit-packaging">Редактировать</button>

                    <form action="{{ route('admin.packaging.destroy', $package->id) }}"
                          method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Удалить упаковку?')">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Упаковок пока нет.</p>
        @endforelse
    </div>

    <script src="{{ asset('js/admin_packaging.js') }}"></script>
@endsection
