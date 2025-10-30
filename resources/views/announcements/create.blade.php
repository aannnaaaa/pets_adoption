<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>609-32</title>
    <style> .is-invalid { color: red; } </style>
</head>
<body>
<h2>Добавление объявления</h2>
<form method="post" action="{{url('/announcement')}}">
    @csrf
    <label>Владелец:</label>
    <select name="owner_id">
        <option value="">Выберите владельца</option>
        @foreach ($users as $user)
            <option value="{{$user->id}}"
                    @if(old('owner_id') == $user->id) selected @endif>{{$user->name}}</option>
        @endforeach
    </select>
    @error('owner_id')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Название</label>
    <input type="text" name="title" value="{{ old('title') }}"/>
    @error('title')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Вид животного</label>
    <input type="text" name="species" value="{{ old('species') }}"/>
    @error('species')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Порода</label>
    <input type="text" name="breed" value="{{ old('breed') }}"/>
    @error('breed')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Минимальный возраст</label>
    <input type="text" name="age_min" value="{{ old('age_min') }}"/>
    @error('age_min')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Максимальный возраст</label>
    <input type="text" name="age_max" value="{{ old('age_max') }}"/>
    @error('age_max')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Пол:</label>
    <select name="sex">
        <option value="M" @if(old('sex') == 'M') selected @endif>Самец</option>
        <option value="F" @if(old('sex') == 'F') selected @endif>Самка</option>
        <option value="Mixed" @if(old('sex') == 'Mixed') selected @endif>Смешанный</option>
        <option value="Unknown" @if(old('sex') == 'Unknown' || !old('sex')) selected @endif>Неизвестно</option>
    </select>
    @error('sex')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Количество</label>
    <input type="text" name="count" value="{{ old('count') }}"/>
    @error('count')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Описание</label>
    <input type="text" name="description" value="{{ old('description') }}"/>
    @error('description')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Цена</label>
    <input type="text" name="price" value="{{ old('price') }}"/>
    @error('price')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Город</label>
    <input type="text" name="location_city" value="{{ old('location_city') }}"/>
    @error('location_city')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Фото (URL)</label>
    <input type="text" name="main_photo" value="{{ old('main_photo') }}"/>
    @error('main_photo')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <label>Статус:</label>
    <select name="status">
        <option value="active" @if(old('status') == 'active' || !old('status')) selected @endif>Активное</option>
        <option value="closed" @if(old('status') == 'closed') selected @endif>Закрытое</option>
    </select>
    @error('status')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
    <br>
    <input type="submit" value="Создать">
</form>
</body>
</html>
