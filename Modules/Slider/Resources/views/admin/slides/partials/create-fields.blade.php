<div class="form-group {{ $errors->has("name") ? ' has-error' : '' }}">
    {!! Form::label("name", trans('slider::slides.form.name')) !!}
    {!! Form::text("name", old("name"), ["class" => "form-control", "placeholder" => trans('slider::slides.form.name')]) !!}
    {!! $errors->first("name", '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group">
    <label for="target">{{ trans('slider::slides.form.target') }}</label>
    <select class="form-control" name="target" id="target">
        <option value="_self">{{ trans('slider::slides.form.same tab') }}</option>
        <option value="_blank">{{ trans('slider::slides.form.new tab') }}</option>
    </select>
</div>

<div class="form-group{{ $errors->has("external_image_url") ? ' has-error' : '' }}">
    {!! Form::label("external_image_url", trans('slider::sliders.form.external image url')) !!}
    {!! Form::text("external_image_url", old("external_image_url"), ['class' => 'form-control', 'placeholder' => trans('slider::sliders.form.placeholder.external image url')]) !!}
    {!! $errors->first("external_image_url", '<span class="help-block">:message</span>') !!}
</div>