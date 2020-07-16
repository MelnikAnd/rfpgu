@extends('layouts.master')

@section('title')
    {{ $page->title }} | @parent
@stop
@section('meta')
    <meta name="title" content="{{ $page->meta_title}}" />
    <meta name="description" content="{{ $page->meta_description }}" />
@stop

@section('content')
    <div class="row">
        <div class="notdefault-container">
            <h1 align="center">{{ $page->title }}</h1>
            {!! $page->body !!}
        </div>
        <div class="notdefault-sidebar">
            <ul>
                <li><a href="/university/history">История филиала</a></li>
                <li><a href="/university/struct">Структура</a></li>
                <li><a href="/university/studkom">Студенческое самоуправление</a></li>
                <li><a href="/sveden">Сведения об образовательной организации</a></li>
            </ul>
        </div>
    </div>
@stop
