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
        <div class="main-carousel-container">
            {!! Slider::render('sliderMainPage') !!}
        </div>
        <div class="extra-home-body-container">
            {!! $page->body !!}
        </div>
        <div class="home-body-container">
            <div class="home-cards">
                <div class="home-cards-column">
                    <h2><a href="/ann">Объявления</a></h2>
                    @if (count($ann_posts))
                        @foreach($ann_posts as $post)
                            <div class="home-card">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="{{$post->url}}">{{$post->title}}</a></h3>
                                        @if($post->mainimage->path=='http://rfpgu.test/assets/media/service/default.jpg'||$post->mainimage->path=='http://rfpgu.ru/assets/media/service/default.jpg'||$post->mainimage->path=='http://new.rfpgu.ru/assets/media/service/default.jpg')
                                        @else
                                            <div class="bgimg">
                                                <a href="{{$post->url}}"><img class="image img-responsive" src="{{url($post->mainimage->path)}}" alt="{{$post->title}}"/></a>
                                            </div>
                                        @endif
                                        <p class="card-text">{{$post->summary}}</p>
                                        <a href="{{$post->url}}"
                                           class="btn btn-primary">{{trans('iblog::common.button.read more')}} &rarr;</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{trans('iblog::common.Posted on')}} {{format_date($post->created_at,'%d.%m.%G')}}
                                    </div>
                                </div>
                            </div>
                            @if($loop->iteration == 5)
                                @break
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="home-cards-column">
                    <h2><a href="/news">Новости</a></h2>
                    @if (count($news_posts))
                        @foreach($news_posts as $post)
                            <div class="home-card">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="{{$post->url}}">{{$post->title}}</a></h3>
                                        @if($post->mainimage->path=='http://rfpgu.test/assets/media/service/default.jpg'||$post->mainimage->path=='http://rfpgu.ru/assets/media/service/default.jpg'||$post->mainimage->path=='http://new.rfpgu.ru/assets/media/service/default.jpg')
                                        @else
                                            <div class="bgimg">
                                                <a href="{{$post->url}}"><img class="image img-responsive" src="{{url($post->mainimage->path)}}" alt="{{$post->title}}"/></a>
                                            </div>
                                        @endif
                                        <p class="card-text">{{$post->summary}}</p>
                                        <a href="{{$post->url}}"
                                           class="btn btn-primary">{{trans('iblog::common.button.read more')}} &rarr;</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{trans('iblog::common.Posted on')}} {{format_date($post->created_at,'%d.%m.%G')}}
                                    </div>
                                </div>
                            </div>
                            @if($loop->iteration == 5)
                                @break
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="home-cards-column">
                    <h2><a href="/events">Мероприятия</a></h2>
                    @if (count($events_posts))
                        @foreach($events_posts as $post)
                            <div class="home-card">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="card-title"><a href="{{$post->url}}">{{$post->title}}</a></h3>
                                        @if($post->mainimage->path=='http://rfpgu.test/assets/media/service/default.jpg'||$post->mainimage->path=='http://rfpgu.ru/assets/media/service/default.jpg'||$post->mainimage->path=='http://new.rfpgu.ru/assets/media/service/default.jpg')
                                        @else
                                            <div class="bgimg">
                                                <a href="{{$post->url}}"><img class="image img-responsive" src="{{url($post->mainimage->path)}}" alt="{{$post->title}}"/></a>
                                            </div>
                                        @endif
                                        <p class="card-text">{{$post->summary}}</p>
                                        <a href="{{$post->url}}"
                                           class="btn btn-primary">{{trans('iblog::common.button.read more')}} &rarr;</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{trans('iblog::common.Posted on')}} {{format_date($post->created_at,'%d.%m.%G')}}
                                    </div>
                                </div>
                            </div>
                            @if($loop->iteration == 5)
                                @break
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="btn-units">
                <a href="/abitur" class="btn-unit">Абитуриентам</a>
                <a href="/" class="btn-unit">Студентам</a>
                <a href="/" class="btn-unit">Преподавателям</a>
                <a href="/kafedra_iipi" class="btn-unit">Кафедры</a>
                <a href="http://bibl.rfpgu.ru/" class="btn-unit">Библиотека</a>
            </div>
        </div>
    </div>
@stop
