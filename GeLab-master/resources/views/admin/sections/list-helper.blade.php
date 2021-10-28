<ol class="dd-list">
  @foreach ($sections as $section)
    <li class="dd-item" data-id="{{ $section->id }}">
      <div class="dd-handle" style="">
        {{ $section->title }}
      </div>
      <div class="change-icons">
        @if ($section->type['type'] !== 0) 
          @if ($section->post() !== null && count($section->post()->submissions) > 0)
              
          <a href="/{{ app()->getLocale() }}/admin/submissions?post_id={{ $section->post()->id }}"  class="far fa-envelope"></a> 
          @endif
          <a href="/{{ app()->getLocale() }}/admin/section/{{ $section->id }}/posts/"  class="far fa-eye"></a> 
        @endif
        @if (auth()->user()->isType('admin'))
          <a href="/{{ app()->getLocale() }}/admin/sections/edit/{{ $section->id }}"  class="fas fa-pencil-alt"></a>
          <a href="/{{ app()->getLocale() }}/admin/sections/destroy/{{ $section->id }}" data-action="" onclick="return confirm_alert(this);" class="fas fa-trash-alt"></a>
        @endif
      </div>
      @if (count($section->children) > 0 )
        @include('admin.sections.list-helper', ['sections' => $section->children])
      @endif
    </li>
  @endforeach
</ol>

<script>
  function confirm_alert(node) {
    return confirm("Do you want to delete this Section?");
  }
</script>