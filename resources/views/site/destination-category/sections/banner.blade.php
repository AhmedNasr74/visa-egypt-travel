<!-- breadcrumb area start -->
<div class="breadcrumb-area style-two jarallax" style="background-image:url('{{ $bannerImage }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="page-title">{{ $title }}</h1>
                    <ul class="page-list">
                        <li><a href="{{ route('site.home') }}">{{ __('main.home') }}</a></li>
                        <li>{{ $title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area End -->
