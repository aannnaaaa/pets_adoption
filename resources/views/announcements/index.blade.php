@extends('layout')

@section('title', 'Список объявлений')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Объявления о животных</h2>
        @auth
            @if(Auth::user()->role === 'owner' || Auth::user()->role === 'shelter' || Auth::user()->role === 'admin')
                <a href="/announcements/create" class="btn btn-success">Создать объявление</a>
            @endif
        @endauth
    </div>

    @if($announcements->count() > 0)
        <div class="row">
            @foreach($announcements as $announcement)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($announcement->main_photo)
                            <img src="{{ Storage::url($announcement->main_photo) }}"
                                 class="card-img-top"
                                 alt="{{ $announcement->title }}"
                                 style="height: 200px; object-fit: cover;">

                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span>Нет фото</span>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                <small>{{ $announcement->species }} @if($announcement->breed) • {{ $announcement->breed }} @endif</small>
                            </p>
                            <p class="card-text">
                                <strong>Цена:</strong> {{ number_format($announcement->price, 2) }} ₽<br>
                                <strong>Локация:</strong> {{ $announcement->location_city }}<br>
                                <strong>Статус:</strong>
                                <span class="badge bg-{{ $announcement->status === 'active' ? 'success' : 'secondary' }}">
                        {{ $announcement->status === 'active' ? 'Активно' : 'Закрыто' }}
                    </span>
                            </p>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="d-flex gap-2">
                                <a href="/announcements/{{ $announcement->id }}" class="btn btn-sm btn-primary flex-fill">Подробнее</a>

                                @auth
                                    @if(Auth::user()->id === $announcement->owner_id)
                                        <a href="/announcements/{{ $announcement->id }}/edit" class="btn btn-sm btn-warning">Редактировать</a>
                                    @endif

                                    @if(Auth::user()->role === 'admin' || Auth::user()->id === $announcement->owner_id)
                                        <form method="POST" action="/announcements/{{ $announcement->id }}" class="d-inline" onsubmit="return confirm('Вы уверены, что хотите удалить это объявление?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $announcements->links() }}
        </div>

    @else
        <div class="alert alert-info text-center">
            <h4>Объявлений пока нет</h4>
            <p>Будьте первым, кто создаст объявление!</p>
        </div>
    @endif
@endsection
