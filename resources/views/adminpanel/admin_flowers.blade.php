@extends('adminpanel.layouts.app')

@section('title', 'Цветы')

@section('content')
    <div class="admin-actions">
        <button id="btn-add-flower" class="btn btn-primary">Добавить цветок</button>
    </div>

    <div class="modal" id="flower-modal">
        <div class="modal-content">
            <span class="close" id="close-flower-modal">&times;</span>
            <h2 id="modal-title">Добавить цветок</h2>
            <form id="flower-form" method="POST" enctype="multipart/form-data" data-store-url="{{ route('admin.flowers.store') }}">
                @csrf
                <input type="hidden" name="flower_id" id="flower-id">
                <div id="current-image" style="margin-bottom:10px;"></div>
                <div class="form-group">
                    <label for="flower-name">Название</label>
                    <input type="text" id="flower-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="flower-price">Цена</label>
                    <input type="number" step="0.01" id="flower-price" name="price">
                </div>
                <div class="form-group">
                    <label for="flower-image">Фото</label>
                    <input type="file" id="flower-image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

    <!-- Карточки цветов -->
    <div class="cards-container">
        @forelse($flowers as $flower)
            <div class="card" data-id="{{ $flower->id }}">
                <h3 class="flower-name">{{ $flower->name }}</h3>
                <p class="flower-price">{{ $flower->price ? $flower->price . ' ₽' : '-' }}</p>
                @if($flower->image)
                    <img src="{{ asset('storage/' . $flower->image) }}" class="flower-image" alt="{{ $flower->name }}">
                @endif
                <div class="card-actions">
                    <button class="btn btn-warning edit-flower"
                            data-id="{{ $flower->id }}"
                            data-name="{{ $flower->name }}"
                            data-price="{{ $flower->price }}"
                            data-image="{{ $flower->image ? asset('storage/' . $flower->image) : '' }}"
                            data-update-url="{{ route('admin.flowers.update', $flower->id) }}">
                        Редактировать
                    </button>
                    <form action="{{ route('admin.flowers.destroy', $flower->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Цветов пока нет.</p>
        @endforelse
    </div>
    <script src="{{ asset('js/admin_flowers.js') }}"></script>
@endsection

