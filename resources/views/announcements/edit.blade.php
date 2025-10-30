<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
    <style> .is-invalid { color: red; } </style>
</head>
<body>
<h2>Редактирование объявления</h2>
<form method="post" action="{{url('/announcement/update/'.$announcement->id)}}">
    @csrf

    <label>Название</label>
    <input type="text" name="title" value="@if (old('title')) {{old('title')}} @else {{$announcement->title}} @endif "/>
    @error('title')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Вид животного</label>
    <input type="text" name="species" value="@if (old('species')) {{old('species')}} @else {{$announcement->species}} @endif "/>
    @error('species')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Порода</label>
    <input type="text" name="breed" value="@if (old('breed')) {{old('breed')}} @else {{$announcement->breed}} @endif "/>
    @error('breed')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Минимальный возраст</label>
    <input type="text" name="age_min" value="@if (old('age_min')) {{old('age_min')}} @else {{$announcement->age_min}} @endif "/>
    @error('age_min')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Максимальный возраст</label>
    <input type="text" name="age_max" value="@if (old('age_max')) {{old('age_max')}} @else {{$announcement->age_max}} @endif "/>
    @error('age_max')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Пол:</label>
    <select name="sex">
        <option value="M" @if(old('sex') == 'M' || (!old('sex') && $announcement->sex == 'M')) selected @endif>Самец</option>
        <option value="F" @if(old('sex') == 'F' || (!old('sex') && $announcement->sex == 'F')) selected @endif>Самка</option>
        <option value="Mixed" @if(old('sex') == 'Mixed' || (!old('sex') && $announcement->sex == 'Mixed')) selected @endif>Смешанный</option>
        <option value="Unknown" @if(old('sex') == 'Unknown' || (!old('sex') && $announcement->sex == 'Unknown')) selected @endif>Неизвестно</option>
    </select>
    @error('sex')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Количество</label>
    <input type="text" name="count" value="@if (old('count')) {{old('count')}} @else {{$announcement->count}} @endif "/>
    @error('count')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Описание</label>
    <input type="text" name="description" value="@if (old('description')) {{old('description')}} @else {{$announcement->description}} @endif "/>
    @error('description')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Цена</label>
    <input type="text" name="price" value="@if (old('price')) {{old('price')}} @else {{$announcement->price}} @endif "/>
    @error('price')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Город</label>
    <input type="text" name="location_city" value="@if (old('location_city')) {{old('location_city')}} @else {{$announcement->location_city}} @endif "/>
    @error('location_city')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Фото (URL)</label>
    <input type="text" name="main_photo" value="@if (old('main_photo')) {{old('main_photo')}} @else {{$announcement->main_photo}} @endif "/>
    @error('main_photo')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <label>Статус:</label>
    <select name="status">
        <option value="active" @if(old('status') == 'active' || (!old('status') && $announcement->status == 'active')) selected @endif>Активное</option>
        <option value="closed" @if(old('status') == 'closed' || (!old('status') && $announcement->status == 'closed')) selected @endif>Закрытое</option>
    </select>
    @error('status')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>

    <input type="submit">
</form>
</body>
</html>
