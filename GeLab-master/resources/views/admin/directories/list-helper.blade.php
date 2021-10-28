<ol class="dd-list">
  @foreach ($directories as $directory)
    <li class="dd-item" data-id="{{ $directory->id }}">
      <div class="dd-handle" style="">
        {{ $directory->title }}
      </div>
      <div class="change-icons">
        
        @if (auth()->user()->isType('admin'))
          <a href="{{ route('directory.edit', [app()->getLocale(), $directory->id]) }}"  class="fas fa-pencil-alt"></a>
          <a href="{{ route('directory.destroy', [app()->getLocale(), $directory->id]) }}" data-action="" onclick="return confirm_alert(this);" class="fas fa-trash-alt"></a>
		                             
        @endif
      </div>
      @if (count($directory->children) > 0 )
        @include('admin.directories.list-helper', ['directories' => $directory->children])
      @endif
    </li>
  @endforeach
</ol>

<script>
  function confirm_alert(node) {
    return confirm("Do you want to delete this Section?");
  }
</script>