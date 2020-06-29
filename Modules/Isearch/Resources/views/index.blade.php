@extends('layouts.master')
@section('title')
    {{trans('isearch::common.title')}}-{{$searchphrase}} | @parent
@stop
@section('content')

    <div class="page blog isearch">
            <div class="search-index-container">
                <div class="row">

                    <div class="row">
                        <div class="col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="/">Главная</a></li>
                                <li>{{trans('isearch::common.search')}} "{{$searchphrase}}"</li>
                            </ol>
                        </div>
                    </div>

                    <div class="search-container">
                        @include('isearch::forms.search-int-right')
                    </div>

                    <!-- Blog Entries Column -->
                    <div class="col-xs-12 col-md-12 category-body-1">

                        <h1 class="page-header">Результаты поиска для "{{$searchphrase}}"</h1>

                        @if (isset($result) && !empty($result))
                            @foreach($result as $k => $entities)

                                @php $cont = 0; @endphp
                                @foreach($entities['items'] as $result)
                                    <div class="col-xs-6 col-sm-4 contend post post{{$result->id}}">
                                        <div class="content">
                                            <a href="{{$result->url}}"><h2>{{$result->title}}</h2></a>
                                            <p>{!! $result->summary!!}</p>
                                            <a class="btn btn-primary post-link"
                                               href="{{$result->url}}">{{trans('isearch::common.index.Read More')}}<span
                                                        class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                    </div>
                                    @php $cont++; @endphp
                                    @if($cont%3==0)
                                        <div class="clearfix" style="margin-bottom: 14px;"></div>
                                    @endif
                                    @if($cont%2==0)
                                        <div class="clearfix visible-xs-block" style="margin-bottom: 14px;"></div>
                                    @endif
                                @endforeach
                                <div class="clearfix"></div>
                                <div class="pagination paginacion-blog row">
                                    <div class="pull-right">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="error-template">
                                        <h2 class="h1">
                                            Oops!</h2>
                                        <h2>
                                            {{trans('isearch::common.index.Not Found')}} </h2>
                                        <div class="error-details">
                                            {{trans('isearch::common.index.Not msg')}}
                                        </div>
                                        <div class="error-actions">
                                            <a href="{{url('/')}}" class="btn btn-primary btn-lg"><span
                                                        class="glyphicon glyphicon-home"></span>
                                                {{trans('isearch::common.index.Not btn')}} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

    </div>
@stop

@section('scripts')
    @parent
    <link rel="stylesheet" href="{{url('modules/isearch/css/isearch.css')}}">
@endsection