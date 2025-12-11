@extends('adminpanel.layouts.app')

@section('title', 'Букеты')

@section('content')
    <div class="admin-actions">
        <button id="show-add-bouquet" class="btn btn-primary">Добавить букет</button>
    </div>

    <!-- Модалка Добавить / Редактировать -->
    <div id="bouquet-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title">Добавить букет</h2>

            <form id="bouquet-form" method="POST" enctype="multipart/form-data" data-store-url="{{ route('admin.bouquets.store') }}">
            @csrf
                <input type="hidden" id="bouquet-id" name="bouquet_id">

                <div id="current-image" style="margin-bottom:15px;"></div>

                <div class="form-group">
                    <label>Название</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label>Цена</label>
                    <input type="number" step="0.01" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label>Знак зодиака</label>
                    <select id="zodiac_sign" name="zodiac_sign">
                        <option value="">—</option>
                        @foreach(['Овен','Телец','Близнецы','Рак','Лев','Дева','Весы','Скорпион','Стрелец','Козерог','Водолей','Рыбы'] as $sign)
                            <option value="{{ $sign }}">{{ $sign }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Фото</label>
                    <input type="file" id="image" name="image">
                </div>


                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

    <!-- Карточки букетов -->
    <div class="cards-container">
        @forelse($bouquets as $bouquet)
            <div class="card">
                <h3>{{ $bouquet->name }}</h3>

                @if($bouquet->image)
                    <img src="{{ asset('storage/' . $bouquet->image) }}" style="max-width:150px; display:block; margin-bottom:10px;">
                @endif

                <p>Знак: {{ $bouquet->zodiac_sign ?? '—' }}</p>
                <p class="price">{{ $bouquet->price }} ₽</p>

                <div class="card-actions">
                    <button class="btn btn-warning edit-bouquet"
                             data-id="{{ $bouquet->id }}"
                             data-name="{{ $bouquet->name }}"
                             data-price="{{ $bouquet->price }}"
                             data-zodiac="{{ $bouquet->zodiac_sign ?? '' }}"
                             data-image="{{ $bouquet->image ? asset('storage/' . $bouquet->image) : '' }}"
                             data-update-url="{{ route('admin.bouquets.update', $bouquet->id) }}">
                        Редактировать
                    </button>

                    <form action="{{ route('admin.bouquets.destroy', $bouquet->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить букет?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Букетов пока нет.</p>
        @endforelse
    </div>

    <script src="{{ asset('js/admin_bouquets.js') }}"></script>
@endsection
