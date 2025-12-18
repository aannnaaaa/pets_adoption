@extends('layout')

@section('title', 'Мои сообщения')

@section('content')
    <h2>Мои сообщения</h2>

    @if($messages->count() > 0)
        <div class="list-group">
            @foreach($messages as $message)
                <a href="{{ route('messages.show', $message->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            @if($message->sender_id === Auth::id())
                                Отправлено: {{ $message->receiver->name }}
                            @else
                                Получено от: {{ $message->sender->name }}
                            @endif
                        </h5>
                        <small>{{ $message->sent_at->format('d.m.Y H:i') }}</small>
                    </div>
                    <p class="mb-1">{{ Str::limit($message->text, 100) }}</p>
                    <small>Объявление: {{ $message->announcement->title }}</small>
                    @if($message->receiver_id === Auth::id() && is_null($message->read_at))
                        <span class="badge bg-primary">Новое</span>
                    @endif
                </a>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Сообщений пока нет</div>
    @endif
@endsection
