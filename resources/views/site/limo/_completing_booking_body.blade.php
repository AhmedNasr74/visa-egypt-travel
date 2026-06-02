<header
      class="border-l-4 border-blue-600 bg-black pb-32 pt-11 text-white sm:pb-32 sm:pt-16"
      aria-label="Booking progress"
    >
      <div class="mx-auto max-w-4xl px-4 sm:px-6">
        <div class="flex items-start justify-between gap-2 sm:gap-4" id="cb-stepper" role="list">
          <div class="flex flex-1 items-start" data-cb-step-index="1">
            <div
              class="flex w-full flex-col items-center"
              role="listitem"
              aria-label="Step 1 Flight Details"
            >
              <div
                data-step-circle
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded border-2 text-sm font-bold transition-colors sm:h-10 sm:w-10"
              >
                <span data-step-num>1</span>
                <svg
                  data-step-check
                  class="hidden h-4 w-4"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <p id="cb-step1-label" data-step-label class="mt-2 max-w-[4.5rem] text-center text-[10px] font-medium leading-tight text-violet-200 sm:max-w-[5.5rem] sm:text-xs">
                Flight Details
              </p>
            </div>
          </div>
          <div class="mx-1 mt-4 h-px min-w-[1rem] flex-1 bg-violet-500/50 sm:mt-5 sm:min-w-[2rem]" aria-hidden="true"></div>
          <div class="flex flex-1 items-start" data-cb-step-index="2">
            <div class="flex w-full flex-col items-center" role="listitem" aria-label="Step 2 Booking Details">
              <div
                data-step-circle
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded border-2 text-sm font-bold transition-colors sm:h-10 sm:w-10"
              >
                <span data-step-num>2</span>
                <svg data-step-check class="hidden h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <p data-step-label class="mt-2 max-w-[4.5rem] text-center text-[10px] font-medium leading-tight text-violet-200 sm:max-w-[5.5rem] sm:text-xs">
                Booking Details
              </p>
            </div>
          </div>
          <div class="mx-1 mt-4 h-px min-w-[1rem] flex-1 bg-violet-500/50 sm:mt-5 sm:min-w-[2rem]" aria-hidden="true"></div>
          <div class="flex flex-1 items-start" data-cb-step-index="3">
            <div class="flex w-full flex-col items-center" role="listitem" aria-label="Step 3 Passenger Details">
              <div
                data-step-circle
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded border-2 text-sm font-bold transition-colors sm:h-10 sm:w-10"
              >
                <span data-step-num>3</span>
                <svg data-step-check class="hidden h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <p data-step-label class="mt-2 max-w-[4.5rem] text-center text-[10px] font-medium leading-tight text-violet-200 sm:max-w-[5.5rem] sm:text-xs">
                Passenger Details
              </p>
            </div>
          </div>
          <div class="mx-1 mt-4 h-px min-w-[1rem] flex-1 bg-violet-500/50 sm:mt-5 sm:min-w-[2rem]" aria-hidden="true"></div>
          <div class="flex flex-1 items-start" data-cb-step-index="4">
            <div class="flex w-full flex-col items-center" role="listitem" aria-label="Step 4 Payment">
              <div
                data-step-circle
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded border-2 text-sm font-bold transition-colors sm:h-10 sm:w-10"
              >
                <span data-step-num>4</span>
                <svg data-step-check class="hidden h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </div>
              <p data-step-label class="mt-2 max-w-[4.5rem] text-center text-[10px] font-medium leading-tight text-violet-200 sm:max-w-[5.5rem] sm:text-xs">
                Payment
              </p>
            </div>
          </div>
        </div>

        <h1 class="mt-16 text-center text-2xl font-bold tracking-tight sm:text-3xl">
          Complete Your Booking
        </h1>
        <p id="cb-header-subtitle" class="mt-2 text-center text-sm text-white/85 sm:text-base">
          One way · Airport limousine
        </p>
      </div>
    </header>

    <main class="relative z-10 -mt-6 pb-16 sm:-mt-8">
      <div class="-translate-y-24 mx-auto max-w-4xl px-4 sm:px-6">
        <button
          type="button"
          id="cb-back"
          class="mb-3 text-lg font-medium text-white underline decoration-slate-400 underline-offset-2 transition hover:text-accent-main-color disabled:invisible"
          aria-label="Go back"
        >
          ← Go Back
        </button>

        <!-- Vehicle summary (shared) -->
        <article
          class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-lg shadow-slate-900/5"
          data-aos="fade-up"
          data-aos-duration="700"
        >
          <div class="flex flex-col gap-4 p-4 sm:flex-row sm:items-start sm:gap-6 sm:p-6">
            <div class="mx-auto w-full max-w-[220px] shrink-0 sm:mx-0 sm:w-44 md:w-52">
              <img
                src="{{ asset('assets/site/limo/image/visa/Standard.jpg') }}"
                alt="Standard limousine"
                class="h-auto w-full rounded-lg object-cover"
                width="400"
                height="260"
              />
            </div>
            <div class="min-w-0 flex-1">
              <div class="flex flex-col gap-4 sm:flex-row sm:justify-between">
                <div>
                  <h2 id="cb-vehicle-title" class="text-lg font-bold text-slate-900 sm:text-xl">Standard</h2>
                  <p class="mt-1 text-sm text-slate-500">Toyota, Kia 2021 &amp; 2022, or Similar</p>
                </div>
                <div class="text-left sm:text-right">
                  <p class="text-xs font-medium text-slate-500 sm:text-sm" data-bind="trip-price-label">One way trip price</p>
                  <p class="mt-1 text-2xl font-bold text-emerald-600 sm:text-3xl" data-bind="vehicle-price">—</p>
                </div>
              </div>
              <div class="mt-4 border-t border-slate-100 pt-4">
                <div class="flex flex-col gap-3 text-sm text-slate-600 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">
                  <div class="flex flex-wrap items-center gap-4">
                    <span class="inline-flex items-center gap-2">
                      <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-width="1.5" stroke-linecap="round" d="M5 11h14v8H5zM7 11V7h10v4" />
                        <circle cx="8" cy="16" r="1" fill="currentColor" />
                        <circle cx="16" cy="16" r="1" fill="currentColor" />
                      </svg>
                      <span data-bind="pax-seats">1 seat</span>
                    </span>
                    <span class="inline-flex items-center gap-2">
                      <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <rect x="6" y="7" width="12" height="12" rx="2" stroke-width="1.5" />
                        <path stroke-width="1.5" stroke-linecap="round" d="M9 7V5h6v2" />
                      </svg>
                      1 Large Bag + 1 Small Bag
                    </span>
                  </div>
                  <button
                    type="button"
                    id="cb-vehicle-gallery-open"
                    class="inline-flex cursor-pointer items-center gap-1.5 border-0 bg-transparent p-0 font-medium text-blue-600 hover:text-blue-700"
                  >
                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                      <rect x="3" y="5" width="7" height="7" rx="1" stroke-width="1.5" />
                      <rect x="14" y="5" width="7" height="7" rx="1" stroke-width="1.5" />
                      <rect x="3" y="14" width="7" height="7" rx="1" stroke-width="1.5" />
                      <rect x="14" y="14" width="7" height="7" rx="1" stroke-width="1.5" />
                    </svg>
                    Vehicle Gallery
                  </button>
                </div>
              </div>
              <div class="mt-4 border-t border-slate-100 pt-3">
                <p class="text-sm font-medium text-emerald-600">
                  <span class="mr-1 inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 align-middle"></span>
                  Free cancellation up to 24 hours before your pick-up
                </p>
              </div>
            </div>
          </div>
        </article>

        <!-- 1: Flight number (airport / travel only) -->
        <section data-cb-page="1" data-cb-flight-only class="mt-4 sm:mt-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
            <label for="cb-flight-input-1" class="block text-sm font-semibold text-slate-900 sm:text-base">
              Enter Arrival Flight Number
            </label>
            <input
              id="cb-flight-input-1"
              type="text"
              autocomplete="off"
              placeholder="e.g. BA777"
              class="mt-3 w-full rounded-xl border border-sky-200 bg-slate-50/80 px-4 py-3 text-sm text-slate-900 outline-none ring-0 transition placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500/20 sm:text-base"
            />
            <div class="mt-6 flex justify-end">
              <button
                type="button"
                data-cb-next
                class="inline-flex items-center gap-2 rounded-full bg-[#1a2744] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-md transition hover:bg-[#243354] sm:px-10 sm:text-base"
              >
                Next
                <span aria-hidden="true" class="text-lg font-light">&gt;</span>
              </button>
            </div>
          </div>
        </section>

        <!-- 2: Flight number + error state (airport / travel only) -->
        <section data-cb-page="2" data-cb-flight-only class="mt-4 hidden sm:mt-6" hidden data-aos="fade-up" data-aos-duration="700" data-aos-delay="120">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
            <label for="cb-flight-input-2" class="block text-sm font-semibold text-slate-900 sm:text-base">
              Enter Arrival Flight Number
            </label>
            <input
              id="cb-flight-input-2"
              type="text"
              autocomplete="off"
              class="mt-3 w-full rounded-xl border border-sky-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:ring-2 focus:ring-blue-500/20 sm:text-base"
            />
            <p id="cb-flight-error-2" class="mt-2 hidden text-sm font-medium text-red-600" role="alert">
              <span class="mr-1 inline-flex h-4 w-4 items-center justify-center rounded-full bg-red-100 text-xs text-red-700" aria-hidden="true">!</span>
              Please Enter a valid Flight Number
            </p>
            <div class="mt-6 flex justify-end">
              <button
                type="button"
                data-cb-next
                class="inline-flex items-center gap-2 rounded-full bg-[#1a2744] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-md transition hover:bg-[#243354] sm:px-10 sm:text-base"
              >
                Next
                <span aria-hidden="true" class="text-lg font-light">&gt;</span>
              </button>
            </div>
          </div>
        </section>

        <!-- 3: Airline, time, terminal, date -->
        <section data-cb-page="3" class="mt-4 hidden sm:mt-6" hidden data-aos="fade-up" data-aos-duration="700" data-aos-delay="140">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
            <div class="flex flex-col gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-center sm:justify-between">
              <h2 data-cb-flight-only class="text-base font-bold text-slate-900 sm:text-lg">Flight Details</h2>
              <h2 data-cb-city-only class="hidden text-base font-bold text-slate-900 sm:text-lg">Trip Details</h2>
              <p class="text-xs text-slate-600 sm:text-sm">
                <span class="font-medium" data-bind="route-pickup">—</span>
                <span class="mx-1 text-slate-400" aria-hidden="true">→</span>
                <span class="font-medium" data-bind="route-drop">—</span>
              </p>
            </div>
            <div data-cb-flight-only class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
              <p class="text-sm text-slate-800">
                Flight Number : <span class="font-semibold" data-bind="flight-number">—</span>
              </p>
            </div>
            <div class="mt-6 space-y-4">
              <div data-cb-flight-only>
                <label for="cb-airline" class="block text-sm font-semibold text-slate-800">Airline</label>
                <input
                  id="cb-airline"
                  type="text"
                  class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                  placeholder="Airline name"
                />
                <p id="cb-airline-error" class="mt-2 hidden text-sm font-medium text-red-600" role="alert">
                  ⚠️ Please enter your airline
                </p>
              </div>
              <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                  <label for="cb-pickup-time" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Pickup Time</label>
                  <div class="relative">
                    <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke-width="1.5" />
                        <path stroke-linecap="round" stroke-width="1.5" d="M12 7v5l3 2" />
                      </svg>
                    </span>
                    <select
                      id="cb-pickup-time"
                      class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                    >
                      <option value="09:00">9:00 AM</option>
                      <option value="23:33" selected>11:33 PM</option>
                      <option value="14:15">2:15 PM</option>
                      <option value="18:45">6:45 PM</option>
                    </select>
                  </div>
                </div>
                <div data-cb-flight-only>
                  <label for="cb-terminal" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Terminal</label>
                  <select
                    id="cb-terminal"
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                  >
                    <option value="T1">T1</option>
                    <option value="T2">T2</option>
                    <option value="T3">T3</option>
                  </select>
                </div>
                <div>
                  <label for="cb-pickup-date" class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-500">Confirm Pickup Date</label>
                  <div class="relative">
                    <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" aria-hidden="true">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="4" y="5" width="16" height="15" rx="2" stroke-width="1.5" />
                        <path stroke-linecap="round" stroke-width="1.5" d="M8 3v4M16 3v4M4 11h16" />
                      </svg>
                    </span>
                    <input
                      id="cb-pickup-date"
                      type="date"
                      class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                    />
                  </div>
                </div>
              </div>
            </div>
            
            <div class="mt-6 flex justify-end">
              <button
                type="button"
                data-cb-next
                class="inline-flex items-center gap-2 rounded-full bg-[#1a2744] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-md transition hover:bg-[#243354] sm:px-10 sm:text-base"
              >
                Next
                <span aria-hidden="true" class="text-lg font-light">&gt;</span>
              </button>
            </div>
          </div>
        </section>

        <!-- 4: Address + read-only flight box (airport / travel only) -->
        <section data-cb-page="4" data-cb-flight-only class="mt-4 hidden sm:mt-6" hidden data-aos="fade-up" data-aos-duration="700" data-aos-delay="160">
          <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
            <div class="flex flex-col gap-2 border-b border-slate-100 pb-4 sm:flex-row sm:items-center sm:justify-between">
              <h2 class="text-base font-bold text-slate-900 sm:text-lg">Flight Details</h2>
              <p class="text-xs text-slate-600 sm:text-sm">
                <span data-bind="route-pickup">—</span>
                <span class="mx-1" aria-hidden="true">→</span>
                <span data-bind="route-drop">—</span>
              </p>
            </div>
            <div class="mt-4 rounded-xl border border-slate-200 bg-slate-50/60 p-4">
              <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-sm font-bold text-slate-900">Flight Details</h3>
              </div>
              <ul class="mt-3 space-y-1.5 text-sm text-slate-700">
                <li>Flight Number: <span id="cb-summary-flight-num" class="font-medium">—</span></li>
                <li>Airline: <span id="cb-summary-airline" class="font-medium">—</span></li>
                <li>
                  Arrival Date &amp; pickup Time:
                  <span class="font-medium" data-bind="pickup-datetime"></span>
                </li>
                <li>Terminal: <span class="font-medium" data-bind="terminal">T1</span></li>
              </ul>
            </div>
            <div class="mt-6">
              <label for="cb-address-input" class="block text-sm font-semibold text-slate-900">Address In Details</label>
              <input
                id="cb-address-input"
                type="text"
                class="mt-2 w-full rounded-xl border border-sky-200 bg-white px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
              />
              <p class="mt-2 text-xs text-slate-500">Make sure your address is accurate and located in Cairo</p>
              
            </div>
            <div class="mt-6 flex justify-end">
              <button
                type="button"
                data-cb-next
                class="inline-flex items-center gap-2 rounded-full bg-[#1a2744] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-md transition hover:bg-[#243354] sm:px-10 sm:text-base"
              >
                Next
                <span aria-hidden="true" class="text-lg font-light">&gt;</span>
              </button>
            </div>
          </div>
        </section>

        <!-- 5: Contact form then passenger layout -->
        <section data-cb-page="5" class="mt-4 hidden sm:mt-6" hidden data-aos="fade-up" data-aos-duration="700" data-aos-delay="180">
          <div id="cb-page5-intro" class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-8">
            <h2 class="text-lg font-bold text-slate-900 sm:text-xl">Your contact details</h2>
            <p class="mt-1 text-sm text-slate-500">Please enter your name, email, phone, and nationality so we can complete your booking.</p>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div class="sm:col-span-2">
                <label for="cb-contact-name" class="text-sm font-semibold text-slate-800">Name</label>
                <input
                  id="cb-contact-name"
                  type="text"
                  class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                />
                <p id="cb-contact-err-name" class="mt-1 hidden text-sm text-red-600">Please enter your name.</p>
              </div>
              <div>
                <label for="cb-contact-email" class="text-sm font-semibold text-slate-800">Email</label>
                <input
                  id="cb-contact-email"
                  type="email"
                  class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                />
                <p id="cb-contact-err-email" class="mt-1 hidden text-sm text-red-600">Please enter a valid email.</p>
              </div>
              <div>
                <label for="cb-contact-phone" class="text-sm font-semibold text-slate-800">Phone Number</label>
                <input
                  id="cb-contact-phone"
                  type="tel"
                  class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                />
                <p id="cb-contact-err-phone" class="mt-1 hidden text-sm text-red-600">Please enter a valid phone number.</p>
              </div>
              <div class="sm:col-span-2">
                <label for="cb-contact-nationality" class="text-sm font-semibold text-slate-800">{{ __('site.nationality') }}</label>
                <input
                  id="cb-contact-nationality"
                  type="text"
                  autocomplete="country-name"
                  placeholder="{{ __('site.nationality') }}"
                  class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 sm:text-base"
                />
              </div>
            </div>
            <div class="mt-8 flex justify-end">
              <button
                type="button"
                id="cb-send-contact"
                class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-10 py-3 text-sm font-bold uppercase tracking-wide text-white shadow-md transition hover:bg-emerald-700 sm:text-base"
              >
                Send
              </button>
            </div>
          </div>

          <div id="cb-page5-main" class="hidden space-y-4" hidden>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-6">
              <div class="rounded-2xl border border-t-4 border-t-[#1a2744] border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
                <h2 class="text-base font-bold text-slate-900 sm:text-lg">Booking Summary</h2>
                <div class="mt-4 space-y-3 text-sm">
             
                  <p class="text-xs uppercase tracking-wide text-slate-500">pick up</p>
                  <p class="font-bold text-slate-900" data-bind="summary-pickup-line">—</p>
                  <p class="text-slate-500" data-bind="pickup-datetime"></p>
                  <div class="flex justify-center py-1 text-slate-400" aria-hidden="true">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-width="2" d="M12 5v14m0 0l-4-4m4 4l4-4" />
                    </svg>
                  </div>
                  <p class="text-xs uppercase tracking-wide text-slate-500" data-bind="summary-drop-heading">Drop-off</p>
                  <p class="font-bold text-slate-900" data-bind="summary-drop-title">—</p>
                  <p class="text-slate-500" data-bind="summary-drop-sub"></p>
                </div>
                <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4 text-sm">
                  <span class="text-slate-600" data-bind="trip-price-label">One way trip price</span>
                  <span class="text-lg font-bold text-emerald-600" data-bind="vehicle-price">—</span>
                </div>
              </div>
              <div class="flex flex-col gap-4">
                <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
                  <h2 class="text-base font-bold text-slate-900 sm:text-lg">Your info</h2>
                  <dl class="mt-4 space-y-2 text-sm text-slate-700">
                    <div><dt class="text-slate-500">Name</dt><dd id="cb-display-name" class="font-medium">—</dd></div>
                    <div><dt class="text-slate-500">Email</dt><dd id="cb-display-email" class="font-medium">—</dd></div>
                    <div><dt class="text-slate-500">Phone</dt><dd id="cb-display-phone" class="font-medium">—</dd></div>
                    <div><dt class="text-slate-500">{{ __('site.nationality') }}</dt><dd id="cb-display-nationality" class="font-medium">—</dd></div>
                  </dl>
                </div>
                <button
                  type="button"
                  data-cb-next
                  class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-4 text-base font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-emerald-700"
                >
                  Next
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </section>

        <!-- 6: Payment — pay on arrival -->
        <section data-cb-page="6" class="mt-4 hidden sm:mt-6" hidden data-aos="fade-up" data-aos-duration="700" data-aos-delay="200">
          <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-6">
            <div class="order-1 rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
              <h2 class="text-base font-bold text-slate-900 sm:text-lg">Booking Summary</h2>
              <div class="mt-4 space-y-2 text-sm text-slate-700">
                <p class="text-xs text-slate-500">pick up: <span data-bind="summary-pickup-line">—</span></p>
                <p class="text-slate-600" data-bind="pickup-datetime"></p>
                <div class="flex justify-center py-1 text-slate-400" aria-hidden="true">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M12 5v14m0 0l-4-4m4 4l4-4" />
                  </svg>
                </div>
                <p class="text-xs text-slate-500"><span data-bind="summary-drop-heading">Drop-off</span>: <span data-bind="summary-drop-title">—</span><span data-bind="summary-drop-sub" class="text-slate-500"></span></p>
              </div>
              <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4 text-sm">
                <span class="text-base font-bold text-slate-900">Final price</span>
                <span class="text-lg font-bold text-emerald-600" data-bind="price-total">—</span>
              </div>
            </div>

            <div class="order-2 space-y-4">
              <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
                <div class="flex flex-wrap items-center justify-between gap-2">
                  <h2 class="text-base font-bold text-slate-900 sm:text-lg">Your info</h2>
                  <button type="button" class="text-sm font-medium text-blue-600 hover:underline">Edit your info</button>
                </div>
                <dl class="mt-4 space-y-2 text-sm text-slate-700">
                  <div><dt class="text-slate-500">Name</dt><dd class="font-medium" data-copy-name></dd></div>
                  <div><dt class="text-slate-500">Email</dt><dd class="font-medium" data-copy-email></dd></div>
                  <div><dt class="text-slate-500">Phone</dt><dd class="font-medium" data-copy-phone></dd></div>
                  <div><dt class="text-slate-500">{{ __('site.nationality') }}</dt><dd class="font-medium" data-copy-nationality></dd></div>
                </dl>
                <label for="cb-booking-notes" class="mt-4 block text-sm font-semibold text-slate-800">Booking Notes</label>
                <textarea
                  id="cb-booking-notes"
                  rows="3"
                  class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                  placeholder="Optional notes for the driver"
                ></textarea>
              </div>

              <div class="rounded-2xl border border-slate-200/80 bg-white p-4 shadow-md sm:p-6">
                <h2 class="text-base font-bold text-slate-900 sm:text-lg">Payment</h2>
                <div class="mt-4 rounded-xl border border-emerald-200/90 bg-emerald-50/60 p-4 sm:p-5">
                  <p class="text-sm font-semibold text-emerald-900">Pay on arrival</p>
                  <p class="mt-2 text-sm leading-relaxed text-slate-700">
                    No credit card is required to complete this booking. You will pay the total amount when you arrive
                    (cash or as agreed with the operator).
                  </p>
                </div>
                <label class="mt-6 flex cursor-pointer items-start gap-3 text-sm text-slate-700">
                  <input id="cb-terms" type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600" />
                  <span>I accept all <a href="#" class="font-medium text-blue-600 underline">terms &amp; conditions</a></span>
                </label>
                <button
                  type="button"
                  id="cb-book-submit"
                  class="mt-6 flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 py-4 text-base font-bold uppercase tracking-wide text-white shadow-lg transition hover:bg-emerald-700"
                >
                  Book
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>

    <!-- Vehicle gallery lightbox -->
    <div
      id="cb-vehicle-gallery"
      class="fixed inset-0 z-50 hidden items-center justify-center bg-black/55 p-4 backdrop-blur-[2px]"
      role="dialog"
      aria-modal="true"
      aria-labelledby="cb-vehicle-gallery-title"
      aria-hidden="true"
    >
      <div
        class="relative max-h-[90vh] w-full max-w-3xl overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-2xl"
        id="cb-vehicle-gallery-panel"
      >
        <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3 sm:px-6">
          <h2 id="cb-vehicle-gallery-title" class="text-lg font-bold text-slate-900">Vehicle Gallery</h2>
          <button
            type="button"
            id="cb-vehicle-gallery-close"
            class="flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
            aria-label="Close gallery"
          >
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="relative bg-slate-50">
          <div class="overflow-hidden">
            <div
              id="cb-vehicle-gallery-track"
              class="flex transition-transform duration-300 ease-out will-change-transform"
              style="transform: translateX(0%)"
            >
              <figure class="min-w-full shrink-0 px-2 py-4 sm:px-4 sm:py-6">
                <img
                  src="{{ asset('assets/site/limo/image/visa/Standard-gall.png') }}"
                  alt="Standard class vehicle interior and exterior"
                  class="mx-auto max-h-[55vh] w-full max-w-full rounded-lg object-contain"
                  width="1200"
                  height="800"
                  loading="lazy"
                />
                <figcaption class="mt-2 text-center text-sm font-medium text-slate-600">Standard</figcaption>
              </figure>
              <figure class="min-w-full shrink-0 px-2 py-4 sm:px-4 sm:py-6">
                <img
                  src="{{ asset('assets/site/limo/image/visa/Premium-gall.png') }}"
                  alt="Premium class vehicle"
                  class="mx-auto max-h-[55vh] w-full max-w-full rounded-lg object-contain"
                  width="1200"
                  height="800"
                  loading="lazy"
                />
                <figcaption class="mt-2 text-center text-sm font-medium text-slate-600">Premium</figcaption>
              </figure>
              <figure class="min-w-full shrink-0 px-2 py-4 sm:px-4 sm:py-6">
                <img
                  src="{{ asset('assets/site/limo/image/visa/Premium-Van-gall.png') }}"
                  alt="Premium van"
                  class="mx-auto max-h-[55vh] w-full max-w-full rounded-lg object-contain"
                  width="1200"
                  height="800"
                  loading="lazy"
                />
                <figcaption class="mt-2 text-center text-sm font-medium text-slate-600">Premium Van</figcaption>
              </figure>
              <figure class="min-w-full shrink-0 px-2 py-4 sm:px-4 sm:py-6">
                <img
                  src="{{ asset('assets/site/limo/image/visa/Luxury-gall.png') }}"
                  alt="Luxury class vehicle"
                  class="mx-auto max-h-[55vh] w-full max-w-full rounded-lg object-contain"
                  width="1200"
                  height="800"
                  loading="lazy"
                />
                <figcaption class="mt-2 text-center text-sm font-medium text-slate-600">Luxury</figcaption>
              </figure>
              <figure class="min-w-full shrink-0 px-2 py-4 sm:px-4 sm:py-6">
                <img
                  src="{{ asset('assets/site/limo/image/visa/eco-luxury-gall.png') }}"
                  alt="Eco luxury class vehicle"
                  class="mx-auto max-h-[55vh] w-full max-w-full rounded-lg object-contain"
                  width="1200"
                  height="800"
                  loading="lazy"
                />
                <figcaption class="mt-2 text-center text-sm font-medium text-slate-600">Eco Luxury</figcaption>
              </figure>
            </div>
          </div>
          <button
            type="button"
            id="cb-vehicle-gallery-prev"
            class="absolute left-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/95 text-slate-700 shadow-md transition hover:bg-white sm:left-3 sm:h-11 sm:w-11"
            aria-label="Previous image"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button
            type="button"
            id="cb-vehicle-gallery-next"
            class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/95 text-slate-700 shadow-md transition hover:bg-white sm:right-3 sm:h-11 sm:w-11"
            aria-label="Next image"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
        <div id="cb-vehicle-gallery-dots" class="flex flex-wrap items-center justify-center gap-2 border-t border-slate-100 px-4 py-3"></div>
      </div>
    </div>
