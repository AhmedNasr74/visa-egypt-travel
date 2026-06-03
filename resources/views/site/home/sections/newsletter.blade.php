<section class="my-20" id="home-newsletter">
    <div class="container">
        <div class="rounded-xl shadow-lg bg-white border border-gray-100 p-8 sm:p-12 text-center" data-aos="fade-up">
            <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('site.subscribe_to_our_newsletter') }}</span>
            <h2 class="text-3xl sm:text-4xl font-semibold capitalize mt-2">{{ __('site.sign_up_to_get_pro_offers') }}</h2>
            <p class="text-zinc-500 my-4 max-w-2xl mx-auto">
                {{ __('site.sign_up_description') }}
            </p>

            <form
                action="{{ route('site.subs') }}"
                method="POST"
                id="home-newsletter-form"
                class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto mt-6"
            >
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="{{ __('site.type_your_email_here') }}"
                    class="flex-1 p-3 rounded-full text-zinc-600 bg-ba4-color border-none focus:ring-0"
                />
                <button
                    type="submit"
                    class="mainBtn rounded-full px-8 whitespace-nowrap"
                    id="home-newsletter-btn"
                >
                    {{ __('site.send') }}
                </button>
            </form>
        </div>
    </div>
</section>

@push('js')
<script>
    $('#home-newsletter-form').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);
        const $btn = $('#home-newsletter-btn');
        $btn.prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin me-2"></i>');

        axios.post($form.attr('action'), $form.serialize())
            .then(function (res) {
                toastr.success(res.data.message);
                $form.trigger('reset');
            })
            .catch(function (error) {
                const msg = error.response?.data?.error
                    ?? error.response?.data?.message
                    ?? '{{ __('main.unexpected-error') }}';
                toastr.error(msg);
            })
            .finally(function () {
                $btn.prop('disabled', false).find('i.fa-spinner').remove();
            });
    });
</script>
@endpush
