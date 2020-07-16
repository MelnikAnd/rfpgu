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
                <li><a href="/science/compos">Состав НМК</a></li>
                <li><a href="http://rfpgu.ru/files/downloads/%D0%BF%D0%BB%D0%B0%D0%BD%20%D0%BD%D0%BC%D0%BA%2019-20.pdf">План работ</a></li>
                <li><a href="/science/conf">Конференции</a></li>
            </ul>
        </div>
    </div>
@stop
