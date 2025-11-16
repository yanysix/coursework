@extends('adminpanel.layouts.app')

@section('title', 'Упаковка')

@section('content')
    <div class="admin-actions">
        <a href="{{ route('admin.packaging.create') }}" class="btn btn-primary">Добавить упаковку</a>
    </div>

    <div class="cards-container">
        @forelse($packagings as $package)
            <div class="card">
                <h3>{{ $package->name }}</h3>
                <p class="price">{{ $package->price ? $package->price.' ₽' : '-' }}</p>
                <div class="card-actions">
                    <a href="{{ route('admin.packaging.edit', $package->id) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('admin.packaging.destroy', $package->id) }}" method="POST" class="inline-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Вы уверены, что хотите удалить эту упаковку?')">Удалить</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Упаковок пока нет.</p>
        @endforelse
    </div>
@endsection
