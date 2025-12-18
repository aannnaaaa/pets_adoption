@extends('layout')

@section('title', 'Операция успешна')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="text-success" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <h3 class="text-success mb-3">Успешно!</h3>
                    <p class="lead">{{ $message }}</p>
                    <div class="mt-4">
                        <a href="/announcements" class="btn btn-primary">Вернуться к списку объявлений</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
