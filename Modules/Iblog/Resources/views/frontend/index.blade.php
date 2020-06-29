@extends('layouts.master')

@section('meta')
    @include('iblog::frontend.partials.category.metas')
@stop
@section('title')
    {{$category->title}} | @parent
@stop
@section('content')
    <div class="blog-category-{{$category->id}}">
        <div class="container">

            <div class="row">

                <!-- Blog Column -->
                <div class="col-md-8">

                    <h1 class="my-4">{{$category->title}}</h1>
                    <p>{{$category->description}}</p>

                    @if (count($posts))
                        @foreach($posts as $post)
                            <!-- Blog Post -->
                                <div class="card mb-4">
                                    <div class="card-body-category">
                                        <h2 class="card-title"><a href="{{$post->url}}">{{$post->title}}</a></h2>
                                        @if($post->mainimage->path=='http://rfpgu.test/assets/media/service/default.jpg'||$post->mainimage->path=='http://rfpgu.ru/assets/media/service/default.jpg')
                                        @else
                                            <a href="{{$post->url}}"><img class="card-img-top"
                                                 src="{{--str_replace('.jpg','_mediumThumb.jpg',$post->mainimage->path)--}}{{$post->mainimage->path}}"
                                                                          alt="{{$post->title}}"></a>
                                        @endif
                                        <p class="card-text">{{$post->summary}}</p>
                                        <a href="{{$post->url}}"
                                           class="btn btn-primary">{{trans('iblog::common.button.read more')}} &rarr;</a>
                                        <div class="card-footer text-muted">
                                            {{trans('iblog::common.Posted on')}} {{format_date($post->created_at,'%d.%m.%G')}}
                                        </div>
                                    </div>
                                </div>
                        @endforeach

                        <!-- Pagination -->
                        <div class="pagination justify-content-center mb-4 pagination paginacion-blog row">
                            <div class="pull-right">
                                {{$posts->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    @else
                        <div class="col-xs-12 con-sm-12">
                            <div class="white-box">
                                <h3>Упс... :(</h3>
                                <h1>404 Посты не найдены</h1>
                                <hr>
                                <p style="text-align: center;">Мы не смогли найти контент, который вы искали.</p>
                            </div
                        </div>
                    @endif

                        </div>

                        <!-- Sidebar Widgets Column -->
                        <div class="col-md-4">

                            <!-- Search Widget -->

                            <div class="card my-4 category-sidebar">
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
                <!-- /.row -->

            </div>
        </div>
@stop
