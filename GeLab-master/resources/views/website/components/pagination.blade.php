@if ($paginator->hasPages())

<div class="paginate">
	<div class="pagination-buttons">
		<a href="{{ $paginator->previousPageUrl() }}" @if ($paginator->onFirstPage()) disabled @endif class="prev"><span class="icon-long-right-arrow"></span>{{ trans('website.prev_page') }}</a>
		<a href="{{ $paginator->nextPageUrl() }}" class="next">{{ trans('website.next_page') }}<span class="icon-long-right-arrow"></span></a>
	</div>

	<div class="pagination-number">
		<a href="{{ $paginator->previousPageUrl() }}" @if ($paginator->onFirstPage()) disabled @endif class="prev"><i class="icon-arrow-right"></i></a>
		@foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
				<span>{{ $page }}</span>
				@else
				@if (($paginator->currentPage() - 3) < $page && ($paginator->currentPage() + 3) > $page)
				<a class="number" href="{{ $url }}"> {{ $page }}</a>
                	
				@endif
                @endif
            @endforeach
        @endif
    @endforeach
		<a href="{{ $paginator->nextPageUrl() }}" class="next"><i class="icon-arrow-right"></i></a>
	</div>
</div>
@endif



