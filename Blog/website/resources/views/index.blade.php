@extends('layouts.app')

@section('title')
    Main
@endsection

@section('content')
    <h1>Main page</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur deleniti eum libero quasi rem saepe! Aliquid blanditiis ea ex iste nostrum rem voluptate. Beatae cum officia perferendis, reprehenderit temporibus tenetur.</p>
@endsection
@section('aside')
    @parent
    <p class="aside__blue">Text</p>
@endsection
