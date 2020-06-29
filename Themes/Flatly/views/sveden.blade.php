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
                <li><a href="/sveden/common">Основные сведения</a></li>
                <li><a href="/sveden/struct">Структура и органы управления</a></li>
                <li><a href="/sveden/document">Документы</a></li>
                <li><a href="/sveden/education">Образование</a></li>
                <li><a href="/sveden/eduStandarts">Образовательные стандарты</a></li>
                <li><a href="/sveden/employees">Руководство. Педагогический (научно-педагогический) состав</a></li>
                <li><a href="/sveden/objects">Материально-техническое обеспечение и оснащенность образовательного процесса</a></li>
                <li><a href="/sveden/grants">Стипендии и иные виды материальной поддержки</li>
                <li><a href="/sveden/paid_edu">Платные образовательные услуги</a></li>
                <li><a href="/sveden/budget">Финансово-хозяйственная деятельность</a></li>
                <li><a href="/sveden/vacant">Вакантные места для приема (перевода)</a></li>
                <li><a href="/sveden/inter">Международное сотрудничество</a></li>
                <li><a href="/sveden/ovz">Доступная среда</a></li>
            </ul>
        </div>
    </div>
@stop
