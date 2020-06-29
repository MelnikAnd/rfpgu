@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('slider::sliders.titles.create slide') }}
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li><a href="{{ route('admin.slider.slider.index') }}"> {{ trans('slider::sliders.title') }}</a></li>
    <li><a href="{{ route('admin.slider.slider.edit', $slider->id) }}">{{ trans('slider::sliders.breadcrumb.slider') }}</a></li>
    <li>{{ trans('slider::sliders.breadcrumb.create slide') }}</li>
</ol>
@stop

@section('styles')
@stop

@section('content')
{!! Form::open(['route' => ['admin.slider.slide.store', $slider->id], 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php $i = 0; ?>
                        <?php foreach (LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                            <?php $i++; ?>
                            <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                @include('slider::admin.slides.partials.create-trans-fields', ['lang' => $locale])
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="box-body">
                    @include('slider::admin.slides.partials.create-fields')
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
            <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
            <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.slider.slider.edit', [$slider->id])}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('footer')
@stop
@section('shortcuts')
@stop

@section('scripts')
<script>
$( document ).ready(function() {
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@stop