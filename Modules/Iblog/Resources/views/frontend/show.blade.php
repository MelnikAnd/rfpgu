@extends('layouts.master')

@section('meta')
    @include('iblog::frontend.partials.post.metas')
@stop

@section('title')
    {{ $post->title }} | @parent
@stop

@section('content')


   <div class="page blog single single-{{$category->slug}} single-{{$category->id}}">
        <div class="container" id="body-wrapper">
            <div class="row">
                <div class="col-md-8">
                        <div class="card-body-category">
                            <h1>{{ $post->title }}</h1>
                            @if($post->mainimage->path=='http://rfpgu.test/assets/media/service/default.jpg'||$post->mainimage->path=='http://rfpgu.ru/assets/media/service/default.jpg')
                            @else
                                <a href="{{$post->url}}"><img class="card-img-top"
                                                              src="{{--str_replace('.jpg','_mediumThumb.jpg',$post->mainimage->path)--}}{{$post->mainimage->path}}"
                                                              alt="{{$post->title}}"></a>
                            @endif
                            {!! $post->description !!}

                            @if(!$tags->isEmpty())
                                <div class="tag">
                                <span class="tags-links">
                                    @foreach($tags as $tag)
                                        <a href="{{$tag->url}}" rel="tag">{{$tag->title}}</a>
                                    @endforeach
                                </span>
                                </div>
                            @endif
                            <div class="card-footer text-muted">
                                {{trans('iblog::common.Posted on')}} {{format_date($post->created_at,'%d.%m.%G')}}
                            </div><br>
                            <a href="{{$category->url}}"
                               class="btn btn-primary">&larr; Назад</a>
                        </div>
                </div>

                <div class="col-md-4">
                    <div class="sidebar-revista">
                        <div class="card-body-category">
                            <h5 class="card-header" style="margin-top: 15px">Поиск</h5>
                            <div style="margin-left: 15px">@include('isearch::forms.search-int-right')</div>
                            <br>
                            <h5 class="card-header">{{trans('iblog::category.list')}}</h5>
                            <div class="listado-cat">
                                <ul>
                                    @php
                                        $categories=get_categories();
                                    @endphp

                                    @if(isset($categories))
                                        @foreach($categories as $index=>$category)
                                            <li><a href="{{url($category->slug)}}">{{$category->title}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    @include('iblog::frontend.partials.post.script')
@stop