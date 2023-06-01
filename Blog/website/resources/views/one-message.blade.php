@extends('layouts.app')

@section('title')
    {{ $data->subject }}
@endsection

@section('content')
    <h1>{{ $data->subject }}</h1>
    <p>{{ $data->name }}</p>
    <p>{{ $data->email }}</p>
    <p>{{ $data->message }}</p>
    <p>{{ $data->created_at }}</p>
    <a href="{{ route('contact-update', $data->id) }}" class="btn btn-primary">Редактировать</a>
    <a href="{{ route('contact-delete', $data->id) }}" class="btn btn-danger">Удалить</a>
@endsection
