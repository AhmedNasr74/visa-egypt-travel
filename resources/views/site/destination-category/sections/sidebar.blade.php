<div class="col-xl-3 col-lg-4 order-lg-1">
    <div class="sidebar-area">
        <div class="widget tour-list-widget">
            <div class="widget-tour-list-search">
                <form class="search-form" action="{{ request()->url() }}">

                    <div class="form-group">
                        <input aria-label="{{ __('main.tour') }}" value="{{ request('tour') }}" type="text"
                               placeholder="{{ __('main.search') }}" name="tour">
                    </div>

                    <div class="form-group">
                        <input aria-label="{{ __('main.budget') }}" value="{{ request('budget') }}" type="text"
                               placeholder="{{ __('main.budget') }}" name="budget">
                    </div>
                    <button class="submit-btn" type="submit"><i class="ti-search"></i></button>
                </form>
            </div>
            <div class="widget-tour-list-meta">
                @isset($destination)
                    <div class="single-widget-search-input-title">
                        <i class="fa fa-map-marker"></i> {{ __('main.destination') }}
                    </div>
                    <div class="single-widget-search-input">
                        <input aria-label="{{ __('main.destination') }}" value="{{ $destination->title }}" readonly
                               type="text">
                    </div>
                @endisset

                @isset($category)
                    <div class="single-widget-search-input-title">
                        <i class="fa fa-circle-o"></i> {{ __('main.category') }}
                    </div>
                    <div class="single-widget-search-input">
                        <input aria-label="{{ __('main.category') }}" value="{{ $category->title }}" readonly
                               type="text">
                    </div>
                @endisset
            </div>
        </div>

    </div>
</div>
