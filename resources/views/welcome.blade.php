@extends('layout')

@section('title', 'Добро пожаловать')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">Объявления о животных</h1>
        <p class="lead text-muted mb-5">Найдите своего нового друга или найдите дом для питомца</p>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                        </div>
                        <h5 class="card-title">Просматривайте объявления</h5>
                        <p class="card-text text-muted">Большой выбор объявлений о продаже и отдаче животных</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-success" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </div>
                        <h5 class="card-title">Создавайте объявления</h5>
                        <p class="card-text text-muted">Разместите информацию о своих питомцах бесплатно</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="text-info" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                            </svg>
                        </div>
                        <h5 class="card-title">Общайтесь напрямую</h5>
                        <p class="card-text text-muted">Связывайтесь с владельцами через встроенный чат</p>
                    </div>
                </div>
            </div>
        </div>

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
