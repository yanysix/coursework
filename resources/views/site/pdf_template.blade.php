<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background-color: {{ $color }}; }
        .message { margin-top: 50px; text-align: center; font-size: 24px; }
        .image { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
<h1 style="text-align: center;">{{ $title }}</h1>
<p class="message">{{ $message }}</p>
@if($image)
    <div class="image">
        <img src="{{ $image }}" style="max-width: 400px;">
    </div>
@endif
</body>
</html>
