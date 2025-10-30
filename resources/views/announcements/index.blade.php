<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
</head>
<body>
<h2>Список объявлений</h2>
<table border="1">
    <thead>
    <td>id</td>
    <td>Наименование</td>
    <td>Цена</td>
    <td>Владелец</td>
    <td>Действия</td>
    </thead>
    @foreach($announcements as $announcement)
        <tr>
            <td>{{$announcement->id}}</td>
            <td>{{$announcement->title}}</td>
            <td>{{$announcement->price}}</td>
            <td>{{$announcement->owner->name}}</td>
            <td><a href="{{url('announcement/destroy/'.$announcement->id)}}">Удалить</a>
                <a href="{{url('announcement/edit/'.$announcement->id)}}">Редактировать</a></td>
        </tr>
    @endforeach
</table>
</body>
</html>
