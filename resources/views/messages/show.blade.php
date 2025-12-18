@extends('layout')

@section('title', 'Сообщение #' . $message->id)

@section('content')
    <div class="card shadow">
        <div class="card-header bg-light">
            <h5 class="mb-0">Сообщение от {{ $message->sender->name }} к {{ $message->receiver->name }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Объявление:</strong> {{ $message->announcement->title }}</p>
            <p><strong>Дата отправки:</strong> {{ $message->sent_at->format('d.m.Y H:i') }}</p>
            @if($message->read_at)
                <p><strong>Прочитано:</strong> {{ $message->read_at->format('d.m.Y H:i') }}</p>
            @endif
            <hr>
            <p>{{ $message->text }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('messages.index') }}" class="btn btn-secondary">Назад к списку</a>
        </div>
    </div>
@endsection
