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
            <td>
                @can('destroy-announcement', $announcement)
                    <a href="{{url('announcement/destroy/'.$announcement->id)}}">Удалить</a>
                @endcan

                @can('update-announcement', $announcement)
                    <a href="{{url('announcement/edit/'.$announcement->id)}}">Редактировать</a>
                @endcan
            </td>
        </tr>
    @endforeach
</table>
{{ $announcements->links() }}
</body>
</html>
