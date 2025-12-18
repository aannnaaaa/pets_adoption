@extends('layout')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">Объявления о животных</h1>
        <p class="lead text-muted mb-5">Найдите своего нового друга или найдите дом для питомца</p>

        <div class="d-flex gap-3 justify-content-center">
            <a href="/announcements" class="btn btn-primary btn-lg px-4">Смотреть объявления</a>
            @guest
                <a href="/login" class="btn btn-outline-primary btn-lg px-4">Войти</a>
            @endguest
            @auth
                <a href="/announcements/create" class="btn btn-success btn-lg px-4">Создать объявление</a>
            @endauth
        </div>
    </div>
@endsection
