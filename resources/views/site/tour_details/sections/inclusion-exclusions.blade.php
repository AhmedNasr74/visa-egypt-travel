<!-- inclusion & exclusions -->
<div id="inclusions" class="bg-[#F2FCFF] p-2 py-4 shadow-md rounded-lg mb-3">
    <div class="flex justify-between flex-wrap">
        <div class="w-auto sm:w-1/2">
            <h2 class="text-2xl capitalize font-semibold text-green-500">
                <i class="bx bx-check-circle me-2"></i>
                {{ __('site.tour_included') }}
            </h2>
            <ul class="list-none mt-4">
                @foreach (Str::of($tour->included)->explode(',') as $included)
                    <li class="mb-2">
                        <i class="bx bx-check me-2 text-green-500 text-xl"></i>
                        <span
                            class="text-zinc-500">{{ \Str::of($included)->trim()->remove('•') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-auto sm:w-1/2">
            <h2 class="text-2xl capitalize font-semibold text-red-500">
                <i class="bx bx-x-circle me-2"></i>
                {{ __('site.tour_excluded') }}
            </h2>
            <ul class="list-none mt-4">
                @foreach (Str::of($tour->excluded)->explode(',') as $excluded)
                    <li class="mb-2">
                        <i class="bx bx-x-circle me-2 text-red-500 text-xl"></i>
                        <span
                            class="text-zinc-500">{{ \Str::of($excluded)->trim()->remove('•') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<hr/>
