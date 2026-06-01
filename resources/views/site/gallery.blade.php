@php
    $gallery = setting(App\Enums\SettingKey::OUR_GROUP->value) ?? [];
@endphp
<section data-aos="zoom-in-up" data-aos-delay="150" class="my-8">
    <div class="container">
        <div class="partnerSlider owl-carousel owl-theme">
            @foreach ( $gallery as $pic )
                <div><img src="{{ $pic }}" class="w-full h-20" alt=""/></div>
            @endforeach
        </div>
    </div>
</section>
