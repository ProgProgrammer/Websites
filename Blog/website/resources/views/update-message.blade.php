@extends('layouts.app')

@section('title')
    Изменение записи
@endsection

@section('content')
    <h1>Изменение записи</h1>
    <form action="{{ route('contact-update-submit', $data->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Введите имя:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="email">Введите email:</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $data->email }}" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="subject">Тема сообщения:</label>
            <input type="text" name="subject" id="subject" class="form-control" value="{{ $data->subject }}" placeholder="Тема">
        </div>
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Сообщение">{{ $data->message }}</textarea>
        </div>
        <button type="submit" class="btn btn-success form-button">Обновить</button>
    </form>
@endsection
