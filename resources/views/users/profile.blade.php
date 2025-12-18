@extends('layout')

@section('title', 'Профиль пользователя')

@section('content')
    <div class="row">
        <!-- информация о пользователе -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 2.5rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">
                        <span class="badge bg-info">{{ $user->role }}</span>
                    </p>

                    <hr>

                    <div class="text-start">
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                        @if($user->phone)
                            <p class="mb-2"><strong>Телефон:</strong> {{ $user->phone }}</p>
                        @endif
                        @if($user->city)
                            <p class="mb-2"><strong>Город:</strong> {{ $user->city }}</p>
                        @endif
                        @if($user->last_login)
                            <p class="mb-2"><strong>Последний вход:</strong> {{ $user->last_login->format('d.m.Y H:i') }}</p>
                        @endif
                        <p class="mb-0"><strong>Регистрация:</strong> {{ $user->created_at->format('d.m.Y') }}</p>
                    </div>

                    @if(Auth::id() === $user->id)
                        <hr>
                        <a href="#" class="btn btn-primary w-100">Редактировать профиль</a>
                    @endif
                </div>
            </div>

            <!-- статистика отзывов -->
            <div class="card shadow mt-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Рейтинг</h5>
                </div>
                <div class="card-body">
                    @if($avgRating > 0)
                        <div class="text-center mb-3">
                            <div class="display-4 text-warning">{{ number_format($avgRating, 1) }}</div>
                            <small class="text-muted">на основе {{ $reviewsCount }} отзывов</small>
                        </div>
                    @else
                        <p class="text-center text-muted">Отзывов пока нет</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- объявления и отзывы -->
        <div class="col-lg-8">
            <ul class="nav nav-tabs mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#announcements" type="button" role="tab">Объявления</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Отзывы</button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- объявления -->
                <div class="tab-pane fade show active" id="announcements" role="tabpanel">
                    @if($announcements->count() > 0)
                        <div class="row">
                            @foreach($announcements as $announcement)
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        @if($announcement->main_photo)
                                            <img src="{{ Storage::url($announcement->main_photo) }}" class="card-img-top" alt="{{ $announcement->title }}" style="height: 150px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 150px;">
                                                <span>Нет фото</span>
                                            </div>
                                        @endif

                                        <div class="card-body">
                                            <h6 class="card-title">{{ Str::limit($announcement->title, 50) }}</h6>
                                            <p class="text-muted small mb-2">{{ $announcement->species }} @if($announcement->breed) • {{ $announcement->breed }} @endif</p>
                                            <p class="mb-0"><strong>{{ number_format($announcement->price, 2) }} ₽</strong></p>
                                            <small class="text-muted">{{ $announcement->location_city }}</small>
                                        </div>

                                        <div class="card-footer bg-white d-flex gap-2">
                                            <a href="/announcements/{{ $announcement->id }}" class="btn btn-sm btn-primary flex-fill">Подробнее</a>
                                            @if(Auth::id() === $user->id)
                                                <a href="/announcements/{{ $announcement->id }}/edit" class="btn btn-sm btn-warning">Редактировать</a>
                                                <form method="POST" action="/announcements/{{ $announcement->id }}" onsubmit="return confirm('Удалить объявление?');">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <p class="mb-0">У пользователя пока нет объявлений</p>
                        </div>
                    @endif
                </div>

                <!-- отзывы -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    @if($reviews->count() > 0)
                        <div class="mb-3">
                            <h5>Отзывы о пользователе</h5>
                        </div>
                        @foreach($reviews as $review)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-1">{{ $review->reviewer->name }}</h6>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        ⭐
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                                <span class="text-muted ms-2">({{ $review->rating }}/5)</span>
                                            </div>
                                        </div>

                                    </div>
                                    @if($review->comment)
                                        <p class="mb-0 text-muted">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info text-center mb-4">
                            <p class="mb-0">Отзывов пока нет</p>
                        </div>
                    @endif

                    <!-- форма для отзыва -->
                    @auth
                        @if(Auth::id() !== $user->id)
                            <div class="card shadow">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">Оставить отзыв</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('reviews.store', $user->id) }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Оценка <span class="text-danger">*</span></label>
                                            <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                                <option value="">Выберите оценку</option>
                                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - Очень плохо</option>
                                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - Плохо</option>
                                                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - Нормально</option>
                                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - Хорошо</option>
                                                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - Отлично</option>
                                            </select>
                                            @error('rating')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Комментарий</label>
                                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                                            @error('comment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-success">Отправить отзыв</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
