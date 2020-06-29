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
            <h5>Кафедры</h5>
            <ul>
                <li><a href="/kafedra_iipi">Информатики и программной инженерии</a></li>
                <li><a href="/kafedra_management">Менеджмента</a></li>
                <li><a href="/kafedra_dpi">Декоративно-прикладного искусства</a></li>
                <li><a href="/kafedra_pive">Прикладной информатики в экономике</a></li>
                <li><a href="/kafedra_inyaz">Германских языков и методики их преподавания</a></li>
                <li><a href="/kafedra_atpp">Автоматизация технологических процессов и производств</a></li>
                <li><a href="/kafedra_od">Общенаучных дисциплин</a></li>
            </ul>
        </div>
    </div>
@stop