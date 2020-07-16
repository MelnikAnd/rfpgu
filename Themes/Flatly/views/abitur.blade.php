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
                <li><a href="/abitur/bachelor">Бакалавриат</a></li>
                <li><a href="/abitur/magistr">Магистратура</a></li>
                <li><a href="/abitur/training-courses">Подготовительные курсы</a></li>
                <li><a href="http://test.rfpgu.ru/" target="_blank">Заочная лингвистическая школа</a></li>
                <li><a href="/abitur/test-examples">Примеры тестов</a></li>
                <li><a href="http://a.rfpgu.ru/" target="_blank">Информационный ресурс абитуриенту</a></li>
                <li><a href="/abitur/rules">Правила приема</a></li>
            </ul>
        </div>
    </div>
@stop
