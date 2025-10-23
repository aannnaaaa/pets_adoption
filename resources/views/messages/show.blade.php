<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Сообщение</title>
</head>
<body>
<h1>Сообщение №{{ $message->id }}</h1>
<p><b>Объявление:</b> {{ $message->announcement->title }}</p>
<p><b>Отправитель:</b> {{ $message->sender->name }}</p>
<p><b>Получатель:</b> {{ $message->receiver->name }}</p>
<p>{{ $message->text }}</p>
</body>
</html>
