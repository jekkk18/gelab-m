
<div class="form-group col-lg-6 ">
    
    <div class="row">
        {{ Form::label(trans('admin.'.$key), null, ['class' => 'control-label']) }}
        {{ Form::text($key, null, array_merge(['class' => 'form-control', 'placeholder' => "yyyy/mm/dd", 'id' => "datepicker-autoclose"])) }}

    </div>

</div>





