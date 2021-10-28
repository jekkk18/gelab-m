
<div class="form-group">
    {{ Form::label(trans('admin.'.$key), null, ['class' => 'control-label']) }}
    {{ Form::textarea($locale.'['.$key.']', null, [
        'class' => 'form-control ckeditor', 
    ]) }}
</div>

