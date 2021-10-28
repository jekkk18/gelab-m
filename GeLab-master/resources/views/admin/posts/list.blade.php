@extends('admin.layouts.app')

@push('name')
{{ $section->title }}
@endpush







@section('content')


<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div style="display: flex; align-items:center; justify-content: space-between; padding:20px 0">
                <h4 class="mt-0 header-title float-left">{{ trans('admin.posts') }}</h4>

                <a  href="/{{ app()->getLocale() }}/admin/section/{{ $section->id }}/posts/create" type="button" class="float-right btn btn-info waves-effect width-md waves-light">{{ trans('admin.add_post') }}</a>
            
            </div>

            <div class="container-fluid">

                <div class="row">

                    @foreach ($posts as $post)
                        <div class="col-xl-4 col-md-6">
                            <div class="card-box">
                                <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if (count($post->submissions) > 0)
                                            <a style="color: #35b8e0"  href="/{{ app()->getLocale() }}/admin/submissions?post_id={{ $section->post()->id }}" class="dropdown-item">{{ trans('admin.submissions') }}</a>
                                        @endif
                                        <a style="color: #35b8e0"  href="{{ route('post.edit', [app()->getLocale(), $post->id]) }}" class="dropdown-item">{{ trans('admin.edit') }}</a>
                                        <a style="color: #ff3535" href="{{ route('post.destroy', [app()->getLocale(), $post->id]) }}" class="dropdown-item" onclick="return confirm_alert(this);">{{ trans('admin.delete') }}</a>
                                        
                                        
                                    </div>
                                </div>
								
                                <h4 class="header-title mt-0 ">{{ $post->title }} <br> <small>{{ substr(str_replace("&nbsp;", '', strip_tags($post->desc)), 0, 230) }}</small></h4>
								
								@if ($post->thumb == null && isset(json_decode($post->locale_additional)->youtube_Link))
									<img class="img-fluid card-image" src="{{ getVideoImage(json_decode($post->locale_additional)->youtube_Link) }}" alt="Card image cap">
								@else
									<img class="img-fluid card-image" src="/uploads/img/thumb/{{ $post->thumb }}" alt="Card image cap">
								@endif

                            </div>

                        </div><!-- end col -->
                    @endforeach
                    <div class="col-lg-12">
                        {{ $posts->links() }}
                    </div>
                </div>
              <!-- end row -->
          </div>
        </div>
    </div>
</div>
@endsection


<script>
    function confirm_alert(node) {
      return confirm("Do you want to delete this Post?");
    }
  </script>