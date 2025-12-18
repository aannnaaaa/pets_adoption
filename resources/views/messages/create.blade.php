@extends('layout')

@section('title', 'Написать сообщение')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-envelope-plus"></i> Написать сообщение
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ url('/messages') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="receiver_id" class="form-label">
                                <i class="bi bi-person"></i> Получатель <span class="text-danger">*</span>
                            </label>
                            <select name="receiver_id"
                                    id="receiver_id"
                                    class="form-select @error('receiver_id') is-invalid @enderror"
                                    required>
                                <option value="">Выберите получателя</option>
                                @foreach($users as $user)
                                    @if($user->id != auth()->id())
                                        <option value="{{ $user->id }}"
                                                @if(request('receiver_id') == $user->id) selected @endif>
                                            {{ $user->name }} ({{ $user->role }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('receiver_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="announcement_id" class="form-label">
                                <i class="bi bi-card-text"></i> Объявление (опционально)
                            </label>
                            <select name="announcement_id"
                                    id="announcement_id"
                                    class="form-select @error('announcement_id') is-invalid @enderror">
                                <option value="">Не привязано к объявлению</option>
                                @foreach($announcements as $announcement)
                                    <option value="{{ $announcement->id }}"
                                            @if(request('announcement_id') == $announcement->id) selected @endif>
                                        #{{ $announcement->id }} - {{ $announcement->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('announcement_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="text" class="form-label">
                                <i class="bi bi-chat-text"></i> Текст сообщения <span class="text-danger">*</span>
                            </label>
                            <textarea name="text"
                                      id="text"
                                      class="form-control @error('text') is-invalid @enderror"
                                      rows="6"
                                      required
                                      placeholder="Введите ваше сообщение...">{{ old('text') }}</textarea>
                            @error('text')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="bi bi-info-circle"></i> Минимум 10 символов
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/messages') }}" class="btn btn-secondary btn-lg">
                                <i class="bi bi-arrow-left"></i> Отмена
                            </a>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-send"></i> Отправить сообщение
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg border-0 mt-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Правила общения</h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Будьте вежливы и уважительны</li>
                        <li>Не делитесь личными данными в первом сообщении</li>
                        <li>Четко формулируйте свои вопросы</li>
                        <li>Избегайте спама и рекламы</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
