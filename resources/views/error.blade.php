@extends('layout')

@section('title', 'Ошибка доступа')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow text-center border-danger">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-danger" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-danger mb-3">Ошибка доступа</h3>
                    @if(session('message'))
                        <p class="lead">{{ session('message') }}</p>
                    @else
                        <p class="lead">У вас нет прав для выполнения этого действия.</p>
                    @endif
                    <div class="mt-4">
                        <a href="/announcements" class="btn btn-primary">Вернуться к объявлениям</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
