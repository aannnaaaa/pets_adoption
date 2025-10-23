<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Отзывы пользователя</title>
</head>
<body>
<h1>Отзывы, оставленные пользователем {{ $user->name }}</h1>

@if(isset($totalReviews))
    <h2>Всего отзывов: {{ $totalReviews }}</h2>
@endif

@foreach($user->reviewsGiven as $target)
    <div>
        <strong>Кому:</strong> {{ $target->name }}<br>
        <strong>Оценка:</strong> {{ $target->pivot->rating }}<br>
        <strong>Комментарий:</strong> {{ $target->pivot->comment }}<br>
        <small>{{ $target->pivot->created_at }}</small>
        <hr>
    </div>
@endforeach
</body>
</html>
