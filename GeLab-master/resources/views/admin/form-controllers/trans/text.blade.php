<div class="form-group">
    
    {{ Form::label(trans('admin.'.$key), null, ['class' => 'control-label']) }}
    {{ Form::text($locale.'['.$key.']',  null, array_merge(['class' => 'form-control'])) }}

</div>





