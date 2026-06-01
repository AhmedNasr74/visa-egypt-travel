@props([
    'items'
])
@if(ceil($items->total()/ $items->perPage()) >= 2)
    <div class="tp-pagination text-md-center text-left d-inline-block mt-4 mb-3">
        <ul>
            <li title="{{ __('main.previous') }}">
                <a class="prev page-numbers" href="{{ $items->previousPageUrl().'?'. request()->getQueryString() }}">
                    <i class="la la-long-arrow-left"></i>
                </a>
            </li>
            @for($i=1; $i<= ceil($items->total()/ $items->perPage()) ; $i++)
                <li>
                    <a href="{{ url()->current() . "?page=$i".'&'. http_build_query(request()->except('page')) }}"
                        @class(['page-numbers', 'current' => $items->currentPage() == $i])>{{ $i }}</a>
                </li>
            @endfor
            <li title="{{ __('main.next') }}">
                <a class="next page-numbers" href="{{ $items->nextPageUrl().'?'. request()->getQueryString() }}">
                    <i class="la la-long-arrow-right"></i>
                </a>
            </li>
        </ul>
    </div>
@endif

