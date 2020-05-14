@extends('layouts.master')

@section('content-header')
    <h1>Панель управления</h1>
@stop

@section('styles')

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (setting('dashboard::welcome-enabled') === '1')
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Добро пожаловать!</h3>
                    </div>
                    <div class="box-body">
                        <p>Здесь вы можете вносить изменения в сайт</p>
                    </div>
                    @if (setting('core::site-name') === '')
                    <div class="box-footer">
                        <a class="btn btn-default btn-flat" href="{{ route('admin.page.page.index') }}">
                            Добавить страницу
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@stop
