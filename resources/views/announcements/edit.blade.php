@extends('layout')

@section('title', 'Редактировать объявление')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Редактировать объявление #{{ $announcement->id }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST"
                          action="/announcements/{{ $announcement->id }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Название <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $announcement->title) }}" required maxlength="255">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="species" class="form-label">Вид животного <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('species') is-invalid @enderror" id="species" name="species" value="{{ old('species', $announcement->species) }}" required maxlength="100">
                                @error('species')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="breed" class="form-label">Порода</label>
                                <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed', $announcement->breed) }}" maxlength="255">
                                @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="age_min" class="form-label">Возраст от (мес.)</label>
                                <input type="number" class="form-control @error('age_min') is-invalid @enderror" id="age_min" name="age_min" value="{{ old('age_min', $announcement->age_min) }}" min="0">
                                @error('age_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="age_max" class="form-label">Возраст до (мес.)</label>
                                <input type="number" class="form-control @error('age_max') is-invalid @enderror" id="age_max" name="age_max" value="{{ old('age_max', $announcement->age_max) }}" min="0">
                                @error('age_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sex" class="form-label">Пол <span class="text-danger">*</span></label>
                                <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex" required>
                                    <option value="M" {{ old('sex', $announcement->sex) == 'M' ? 'selected' : '' }}>Мужской</option>
                                    <option value="F" {{ old('sex', $announcement->sex) == 'F' ? 'selected' : '' }}>Женский</option>
                                    <option value="Mixed" {{ old('sex', $announcement->sex) == 'Mixed' ? 'selected' : '' }}>Смешанный</option>
                                    <option value="Unknown" {{ old('sex', $announcement->sex) == 'Unknown' ? 'selected' : '' }}>Неизвестно</option>
                                </select>
                                @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="count" class="form-label">Количество</label>
                                <input type="number" class="form-control @error('count') is-invalid @enderror" id="count" name="count" value="{{ old('count', $announcement->count) }}" min="1">
                                @error('count')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Цена (₽) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $announcement->price) }}" required min="0">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location_city" class="form-label">Город <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location_city') is-invalid @enderror" id="location_city" name="location_city" value="{{ old('location_city', $announcement->location_city) }}" required maxlength="100">
                            @error('location_city')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $announcement->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="main_photo" class="form-label">Фото (загрузите новое с устройства, если нужно)</label>
                            @if($announcement->main_photo)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($announcement->main_photo) }}" alt="Текущее фото" style="max-width: 200px; height: auto;">
                                    <p class="text-muted">Текущее фото</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('main_photo') is-invalid @enderror" id="main_photo" name="main_photo" accept="image/*">
                            @error('main_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Статус <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status', $announcement->status) == 'active' ? 'selected' : '' }}>Активно</option>
                                <option value="closed" {{ old('status', $announcement->status) == 'closed' ? 'selected' : '' }}>Закрыто</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Сохранить изменения</button>
                            <a href="/announcements" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
