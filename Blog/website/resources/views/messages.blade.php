@extends('layouts.app')

@section('title')
    Messages
@endsection

@section('content')
    <h1>Messages page</h1>
    @foreach($data as $el)
        <h3 class="mt-5">{{ $el->subject }}</h3>
        <p>{{ $el->email }}</p>
        <p>{{ $el->created_at }}</p>
        <a href="{{ route('contact-data-one', $el->id) }}" class="btn btn-warning">Подробнее</a>
    @endforeach
@endsection
