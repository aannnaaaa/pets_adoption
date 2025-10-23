<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отзывы о пользователе</title>
</head>
<body>
<h1>Отзывы о пользователе {{ $user->name }}</h1>

@if($avgRating && $avgRating->average)
    <h2>Средняя оценка: {{ number_format($avgRating->average, 1) }}</h2>
@endif

@foreach($user->reviewsReceived as $reviewer)
    <div>
        <strong>Автор:</strong> {{ $reviewer->name }}<br>
        <strong>Оценка:</strong> {{ $reviewer->pivot->rating }}<br>
        <strong>Комментарий:</strong> {{ $reviewer->pivot->comment }}<br>
        <small>{{ $reviewer->pivot->created_at }}</small>
        <hr>
    </div>
@endforeach
</body>
</html>
