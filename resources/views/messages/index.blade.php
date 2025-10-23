<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Все сообщения</title>
</head>
<body>
<h1>Все сообщения</h1>

@foreach($messages as $m)
    <div>
        <p><b>Объявление:</b> {{ $m->announcement->title }}</p>
        <p><b>От:</b> {{ $m->sender->name }} → <b>Кому:</b> {{ $m->receiver->name }}</p>
        <p>{{ $m->text }}</p>
        <hr>
    </div>
@endforeach
</body>
</html>
