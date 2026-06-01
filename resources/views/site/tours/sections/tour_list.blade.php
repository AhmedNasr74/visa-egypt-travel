@include('site.tours.sections.banner')

<div class="tour-list-area pd-top-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8 order-lg-12">
                <div class="tp-tour-list-search-area">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <label class="single-input-wrap">
                                <i class="fa fa-calendar-minus-o"></i>
                                <input type="text" class="departing-date hasDatepicker" placeholder="{{ __('main.departing') }}"
                                    id="dp1684322335474">
                            </label>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <label class="single-input-wrap tour-list-search-icon">
                                <i class="la la-arrow-up"></i>
                                <input type="text" placeholder="{{ __('main.price-low-high') }}">
                            </label>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <label class="single-input-wrap tour-list-search-icon">
                                <i class="la la-arrow-down"></i>
                                <input type="text" placeholder="{{ __('main.price-high-low') }}">
                            </label>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <label class="single-input-wrap">
                                <i class="fa fa-paper-plane"></i>
                                <input type="text" placeholder="{{ __('main.name-sort') }}">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="tour-list-area">

                    @foreach ($tours as $tour)
                        <x-site.tour :tour="$tour" />
                    @endforeach
                </div>

            </div>
            <div class="col-xl-3 col-lg-4 order-lg-1">
                <div class="sidebar-area">
                    <div class="widget tour-list-widget">
                        <div class="widget-tour-list-search">
                            <form class="search-form">
                                <div class="form-group">
                                    <input type="text" placeholder="{{ __('site.search') }}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <div class="widget-tour-list-meta">
                            <div class="single-widget-search-input-title"><i class="fa fa-dot-circle-o"></i> {{ __('site.where_from') }}</div>
                            <div class="single-widget-search-input">
                                <input type="text" placeholder="{{ __('site.tour_list_destination') }}">
                            </div>
                            <div class="single-widget-search-input-title"><i class="fa fa-plus-circle"></i> {{ __('site.travel_type') }}</div>
                            <div class="single-widget-search-input">
                                <select class="select w-100 custom-select" style="display: none;">
                                    <option value="1">{{ __('site.tour_list_destination') }}</option>
                                    <option value="2">{{ __('site.two') }}</option>
                                    <option value="3">{{ __('site.three') }}</option>
                                    <option value="3">{{ __('site.four') }}</option>
                                </select>
                                <div class="nice-select select w-100 custom-select" tabindex="0"><span
                                        class="current">{{ __('site.tour_list_destination') }}</span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected">{{ __('site.tour_list_destination') }}</li>
                                        <li data-value="2" class="option">{{ __('site.two') }}</li>
                                        <li data-value="3" class="option">{{ __('site.three') }}</li>
                                        <li data-value="3" class="option">{{ __('site.four') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="single-widget-search-input-title"><i class="fa fa-calendar-minus-o"></i>
                                {{ __('site.departing') }}</div>
                            <div class="single-widget-search-input">
                                <input type="text" class="departing-date custom-select hasDatepicker"
                                    placeholder="{{ __('site.departing') }}" id="dp1684322335475">
                            </div>
                            <div class="single-widget-search-input-title"><i class="fa fa-calendar-minus-o"></i>
                                {{ __('site.returning') }}</div>
                            <div class="single-widget-search-input">
                                <input type="text" class="returning-date custom-select hasDatepicker"
                                    placeholder="{{ __('site.returning') }}" id="dp1684322335476">
                            </div>
                            <div class="single-widget-search-input-title"><i class="fa fa-usd"></i> {{ __('site.price_filter') }}
                            </div>
                            <div class="widget-product-sorting">
                                <div
                                    class="slider-product-sorting ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"
                                        style="left: 0%; width: 77.4359%;"></div><span tabindex="0"
                                        class="ui-slider-handle ui-corner-all ui-state-default"
                                        style="left: 0%;"></span><span tabindex="0"
                                        class="ui-slider-handle ui-corner-all ui-state-default"
                                        style="left: 77.4359%;"></span>
                                </div>
                                <div class="product-range-detail">
                                    <label for="amount">Price: </label>
                                    <input type="text" id="amount" readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget_ads">
                        <a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
