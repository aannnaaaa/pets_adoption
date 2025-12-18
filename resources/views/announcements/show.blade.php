@extends('layout')

@section('title', $announcement->title)

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                @if($announcement->main_photo)
                    <img src="{{ Storage::url($announcement->main_photo) }}" class="card-img-top" alt="{{ $announcement->title }}" style="max-height: 400px; object-fit: cover;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span class="fs-4">Нет фото</span>
                    </div>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h2 class="card-title mb-0">{{ $announcement->title }}</h2>
                        <span class="badge bg-{{ $announcement->status === 'active' ? 'success' : 'secondary' }} fs-6">
                            {{ $announcement->status === 'active' ? 'Активно' : 'Закрыто' }}
                        </span>
                    </div>

                    <h3 class="text-primary mb-3">{{ number_format($announcement->price, 2) }} ₽</h3>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Вид:</strong> {{ $announcement->species }}</p>
                            @if($announcement->breed)
                                <p class="mb-2"><strong>Порода:</strong> {{ $announcement->breed }}</p>
                            @endif
                            <p class="mb-2"><strong>Пол:</strong>
                                @if($announcement->sex === 'M') Мужской
                                @elseif($announcement->sex === 'F') Женский
                                @elseif($announcement->sex === 'Mixed') Смешанный
                                @else Неизвестно
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            @if($announcement->age_min || $announcement->age_max)
                                <p class="mb-2"><strong>Возраст:</strong> от {{ $announcement->age_min ?? '?' }} до {{ $announcement->age_max ?? '?' }}</p>
                            @endif
                            @if($announcement->count)
                                <p class="mb-2"><strong>Количество:</strong> {{ $announcement->count }}</p>
                            @endif
                            <p class="mb-2"><strong>Город:</strong> {{ $announcement->location_city }}</p>
                        </div>
                    </div>

                    @if($announcement->description)
                        <h5 class="mb-2">Описание</h5>
                        <p class="text-muted mb-4">{{ $announcement->description }}</p>
                    @endif

                    @auth
                        @if(Auth::user()->id === $announcement->owner_id || Auth::user()->role === 'admin')
                            <div class="d-flex gap-2 mb-4">
                                <a href="/announcements/{{ $announcement->id }}/edit" class="btn btn-warning">Редактировать</a>
                                <form method="POST" action="/announcements/{{ $announcement->id }}" onsubmit="return confirm('Вы уверены?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Информация о владельце</h5>
                </div>
                <div class="card-body">
                    @if($announcement->owner)
                        <p class="mb-2"><strong>Имя:</strong> <a href="{{ route('users.show', $announcement->owner->id) }}">{{ $announcement->owner->name }}</a></p>
                        <p class="mb-2"><strong>Роль:</strong>
                            <span class="badge bg-info">{{ $announcement->owner->role }}</span>
                        </p>
                        @if($announcement->owner->phone)
                            <p class="mb-2"><strong>Телефон:</strong> {{ $announcement->owner->phone }}</p>
                        @endif
                        @if($announcement->owner->city)
                            <p class="mb-2"><strong>Город:</strong> {{ $announcement->owner->city }}</p>
                        @endif
                        @auth
                            <a href="#" class="btn btn-primary w-100 mt-3">Написать сообщение</a>
                        @endauth
                    @else
                        <p class="text-muted">Информация о владельце недоступна</p>
                    @endif
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Статистика</h6>
                    <p class="mb-2"><strong>Просмотры:</strong> {{ $announcement->views }}</p>
                    <p class="mb-0"><strong>ID объявления:</strong> #{{ $announcement->id }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="/announcements" class="btn btn-secondary">← Назад к списку</a>
    </div>
@endsection
