@extends('admin.layouts.app')

@push('name')
{{ trans('admin.submission') }} 
@endpush



@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                
                <h4 class=" ">{{ $submission->post->translate(app()->getLocale())->title }} </h4>
                <h4>{{ $submission->created_at->format('H:i d.m.Y') }}</h4>
                
                
            </div>
            
            <h5><b>{{ trans('admin.email') }}:</b> {{  $submission->email }}</h5>

            <h5><b>{{ trans('admin.name') }}:</b> {{  $submission->name }}</h5>
            @foreach ($submission->additional as $key => $additional)
            
            <h5><b>{{ trans('admin.'.$key) }}:</b> {{  $additional }}</h5>
                
            @endforeach

            <h5>{{ trans('admin.text')}}:</h5>
            <p>{{ $submission->text }}</p>
            

            
        </div>
    </div>
</div>
@endsection


