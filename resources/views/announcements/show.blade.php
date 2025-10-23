<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
</head>
<body>
    <h1>{{ $announcement->title }}</h1>
    <p>Автор: {{ $announcement->owner->name }}</p>
    <p>{{ $announcement->description }}</p>
    <p>Цена: {{ $announcement->price }} ₽</p>

    <h3>Сообщения по этому объявлению:</h3>
    @foreach($announcement->messages as $m)
        <p><b>{{ $m->sender->name }}:</b> {{ $m->text }}</p>
    @endforeach
</body>
</html>
