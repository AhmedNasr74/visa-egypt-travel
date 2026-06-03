<section class="my-20" id="home-faq-contact">
    <div class="container">
        <div class="grid gap-8 grid-cols-1 lg:grid-cols-2">
            {{-- FAQ accordion (left on desktop) --}}
            <div data-aos="fade-right">
                <div class="mb-6">
                    <span class="text-2xl font-dancingFont text-second-color capitalize">{{ __('site.faq') }}</span>
                    <h2 class="text-3xl sm:text-4xl font-semibold capitalize">{{ __('site.home_faqs_title') }}</h2>
                </div>

                <div class="space-y-3" id="home-faq-accordion">
                    @forelse ($homeFaqs as $i => $faq)
                        <div class="border border-gray-200 rounded-lg shadow-sm overflow-hidden home-faq-item">
                            <button
                                type="button"
                                class="home-faq-toggle flex w-full items-center justify-between gap-3 p-4 text-start bg-white hover:bg-gray-50 transition-time"
                                aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                            >
                                <h3 class="text-base font-semibold capitalize text-second-color pe-2">
                                    {!! $faq->question !!}
                                </h3>
                                <span class="flex-shrink-0 text-second-color text-xl leading-none home-faq-icon" aria-hidden="true">
                                    <i class="fa fa-plus home-faq-plus {{ $i === 0 ? 'hidden' : '' }}"></i>
                                    <i class="fa fa-minus home-faq-minus {{ $i === 0 ? '' : 'hidden' }}"></i>
                                </span>
                            </button>
                            <div class="home-faq-panel px-4 pb-4 {{ $i === 0 ? '' : 'hidden' }}">
                                <div class="text-zinc-600 text-sm leading-relaxed border-t border-gray-100 pt-3">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-zinc-500">{{ __('site.home_faqs_title') }}</p>
                    @endforelse
                </div>

                @if ($homeFaqs->isNotEmpty())
                    <div class="mt-6">
                        <a href="{{ route('site.faq') }}" class="mainBtn inline-block capitalize">
                            {{ __('site.view_all_faqs') }}
                        </a>
                    </div>
                @endif
            </div>

            {{-- Contact form (right on desktop) --}}
            <div class="bg-second-color rounded-xl p-6 sm:p-8 text-white h-full" data-aos="fade-left">
                <div class="mb-6">
                    <span class="text-2xl font-dancingFont capitalize opacity-90">{{ __('site.contact_us') }}</span>
                    <h2 class="text-3xl sm:text-4xl font-bold capitalize">{{ __('site.keep_in_touch') }}</h2>
                </div>

                <form
                    id="home-contact-form"
                    action="{{ route('site.con-store') }}"
                    method="POST"
                    class="grid gap-4 sm:grid-cols-2"
                >
                    @csrf
                    <input type="hidden" name="type" value="homepage_booking">

                    <div>
                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="{{ __('site.first_name') }}"
                            class="w-full p-3 rounded-md bg-transparent border-0 border-b border-white/50 text-white placeholder:text-white/70 focus:ring-0 focus:border-white capitalize"
                        />
                    </div>
                    <div>
                        <input
                            type="text"
                            name="subject"
                            required
                            placeholder="{{ __('site.how_can_i_help_you') }}"
                            class="w-full p-3 rounded-md bg-transparent border-0 border-b border-white/50 text-white placeholder:text-white/70 focus:ring-0 focus:border-white capitalize"
                        />
                    </div>
                    <div>
                        <input
                            type="email"
                            name="email"
                            required
                            placeholder="{{ __('site.your_email') }}"
                            class="w-full p-3 rounded-md bg-transparent border-0 border-b border-white/50 text-white placeholder:text-white/70 focus:ring-0 focus:border-white capitalize"
                        />
                    </div>
                    <div>
                        <input
                            type="tel"
                            name="phone"
                            required
                            placeholder="{{ __('site.mobile') }}"
                            class="w-full p-3 rounded-md bg-transparent border-0 border-b border-white/50 text-white placeholder:text-white/70 focus:ring-0 focus:border-white capitalize"
                        />
                    </div>
                    <div class="sm:col-span-2">
                        <textarea
                            name="message"
                            required
                            rows="4"
                            placeholder="{{ __('site.message') }}"
                            class="w-full p-3 rounded-md bg-transparent border-0 border-b border-white/50 text-white placeholder:text-white/70 focus:ring-0 focus:border-white capitalize resize-none"
                        ></textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <button type="submit" class="mainBtn bg-main-color hover:bg-white hover:text-main-color border border-white/30 uppercase w-full sm:w-auto" id="home-contact-btn">
                            {{ __('site.booking') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('js')
<script>
    (function () {
        const accordion = document.getElementById('home-faq-accordion');
        if (!accordion) return;

        accordion.querySelectorAll('.home-faq-toggle').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const item = toggle.closest('.home-faq-item');
                const panel = item.querySelector('.home-faq-panel');
                const plus = item.querySelector('.home-faq-plus');
                const minus = item.querySelector('.home-faq-minus');
                const isOpen = !panel.classList.contains('hidden');

                accordion.querySelectorAll('.home-faq-panel').forEach(function (p) {
                    p.classList.add('hidden');
                });
                accordion.querySelectorAll('.home-faq-toggle').forEach(function (t) {
                    t.setAttribute('aria-expanded', 'false');
                });
                accordion.querySelectorAll('.home-faq-plus').forEach(function (i) {
                    i.classList.remove('hidden');
                });
                accordion.querySelectorAll('.home-faq-minus').forEach(function (i) {
                    i.classList.add('hidden');
                });

                if (!isOpen) {
                    panel.classList.remove('hidden');
                    toggle.setAttribute('aria-expanded', 'true');
                    plus.classList.add('hidden');
                    minus.classList.remove('hidden');
                }
            });
        });

        $('#home-contact-form').on('submit', function (e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $('#home-contact-btn');
            $btn.prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin me-2"></i>');

            axios.post($form.attr('action'), $form.serialize(), {
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            })
                .then(function (res) {
                    toastr.success(res.data.message);
                    if (res.data.message2) {
                        setTimeout(function () {
                            toastr.success(res.data.message2);
                        }, 1500);
                    }
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
    })();
</script>
@endpush
