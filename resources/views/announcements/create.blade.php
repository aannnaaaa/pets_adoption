@extends('layout')

@section('title', 'Создать объявление')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Создать новое объявление</h4>
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="/announcements"
                          enctype="multipart/form-data">

                    @csrf

                        <div class="mb-3">
                            <label class="form-label">Владелец</label>
                            <p class="form-control-plaintext">{{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
                            <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Название <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required maxlength="255">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="species" class="form-label">Вид животного <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('species') is-invalid @enderror" id="species" name="species" value="{{ old('species') }}" required maxlength="100" placeholder="Собака, кошка, птица...">
                                @error('species')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="breed" class="form-label">Порода</label>
                                <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed') }}" maxlength="255">
                                @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="age_min" class="form-label">Возраст от (мес.)</label>
                                <input type="number" class="form-control @error('age_min') is-invalid @enderror" id="age_min" name="age_min" value="{{ old('age_min') }}" min="0">
                                @error('age_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="age_max" class="form-label">Возраст до (мес.)</label>
                                <input type="number" class="form-control @error('age_max') is-invalid @enderror" id="age_max" name="age_max" value="{{ old('age_max') }}" min="0">
                                @error('age_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sex" class="form-label">Пол <span class="text-danger">*</span></label>
                                <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                    <option value="M" {{ old('sex') == 'M' ? 'selected' : '' }}>Мужской</option>
                                    <option value="F" {{ old('sex') == 'F' ? 'selected' : '' }}>Женский</option>
                                    <option value="Mixed" {{ old('sex') == 'Mixed' ? 'selected' : '' }}>Смешанный</option>
                                    <option value="Unknown" {{ old('sex') == 'Unknown' ? 'selected' : '' }}>Неизвестно</option>
                                </select>
                                @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="count" class="form-label">Количество</label>
                                <input type="number" class="form-control @error('count') is-invalid @enderror" id="count" name="count" value="{{ old('count', 1) }}" min="1">
                                @error('count')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location_city" class="form-label">Город <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location_city') is-invalid @enderror" id="location_city" name="location_city" value="{{ old('location_city') }}" required maxlength="100">
                            @error('location_city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="main_photo" class="form-label">Фото (загрузите с устройства)</label>
                            <input type="file" class="form-control @error('main_photo') is-invalid @enderror" id="main_photo" name="main_photo" accept="image/*">
                            @error('main_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Статус <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Активно</option>
                                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Закрыто</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Создать объявление</button>
                            <a href="/announcements" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
