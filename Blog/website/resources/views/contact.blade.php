@extends('layouts.app')

@section('title')
    Contact
@endsection

@section('content')
    <h1>Contact page</h1>
    <form action="{{ route('contact-form') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Введите имя:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="email">Введите email:</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="subject">Тема сообщения:</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Тема">
        </div>
        <div class="form-group">
            <label for="message">Сообщение:</label>
            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Сообщение"></textarea>
        </div>
        <button type="submit" class="btn btn-success form-button">Отправить</button>
    </form>
@endsection
