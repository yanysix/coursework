<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Админ-панель | BLOSS')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_flowers.css') }}">
</head>
<body>
<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-logo"><h2>BLOSS Admin</h2></div>
        <nav class="admin-nav">
            <ul>
                <li><a href="{{ route('admin.flowers.admin') }}">Цветы</a></li>
                <li><a href="{{ route('admin.packaging.admin') }}">Упаковка</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Выйти</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
        <header class="admin-header">
            <h1>@yield('title', 'Панель администратора')</h1>
        </header>
        <section class="admin-main">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </section>
    </main>
</div>
</body>
</html>
