@extends('adminpanel.layouts.app')

@section('title', 'Цветы')

@section('content')
    <div class="admin-actions">
        <button id="show-add-flower" class="btn btn-primary">Добавить цветок</button>
    </div>

    <div id="flower-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title">Добавить цветок</h2>
            <div id="current-image" style="margin-bottom:10px;"></div>
            <form id="flower-form" method="POST" enctype="multipart/form-data" data-store-url="{{ route('admin.flowers.store') }}">
                @csrf
                <input type="hidden" id="flower-id" name="flower_id">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Цена</label>
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
                    <label for="image">Фото</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success" id="save-flower">Сохранить</button>
            </form>
        </div>
    </div>

    <div class="cards-container">
        @forelse($flowers as $flower)
            <div class="card" data-id="{{ $flower->id }}">
                <h3>{{ $flower->name }}</h3>
                @if($flower->image)
                    <img src="{{ asset('storage/' . $flower->image) }}" alt="{{ $flower->name }}" class="flower-image">
                @endif
                <p>Знак: {{ $flower->zodiac_sign ?? '—' }}</p>
                <p class="price">{{ $flower->price ? $flower->price.' ₽' : '-' }}</p>

                <div class="card-actions">
                    <button class="btn btn-warning edit-flower">Редактировать</button>
                    <form action="{{ route('admin.flowers.destroy', $flower->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Цветов пока нет.</p>
        @endforelse
    </div>

    <script src="{{ asset('js/admin_flowers.js') }}"></script>
@endsection
