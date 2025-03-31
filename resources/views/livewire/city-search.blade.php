<div
	class="relative z-10"
	role="dialog"
	aria-modal="true"
	x-show="city_search.show"
>
	<div
		x-show="city_search.show"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		class="fixed inset-0 bg-gray-500/25 transition-opacity"
		aria-hidden="true"
	></div>

	<div class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20">
		<div
            x-data="{ show_loader: $wire.entangle('show_loader') }"
			x-show="city_search.show"
			x-transition:enter="transition ease-out duration-300"
			x-transition:enter-start="opacity-0 scale-95"
			x-transition:enter-end="opacity-100 scale-100"
			x-transition:leave="transition ease-in duration-200"
			x-transition:leave-start="opacity-100 scale-100"
			x-transition:leave-end="opacity-0 scale-95"
			x-on:click.outside="city_search.show = false"
			class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white ring-1 shadow-2xl ring-black/5 transition-all"
		>
			<form class="grid grid-cols-1">
				<input
					type="text"
					class="col-start-1 row-start-1 h-12 w-full pr-4 pl-11 text-base text-gray-900 outline-hidden placeholder:text-gray-400 sm:text-sm"
					placeholder="Search for a city..."
					role="combobox"
					aria-expanded="false"
					aria-controls="options"
					id="search-input"
					x-ref="input"
					wire:model="search_term"
					x-on:keyup.debounce.500ms="if ($el.value.length > 3) { show_loader = true; $wire.searchForCity() }"
				>
				<svg
					class="pointer-events-none col-start-1 row-start-1 ml-4 size-5 self-center text-gray-400"
					viewBox="0 0 20 20"
					fill="currentColor"
					aria-hidden="true"
					data-slot="icon"
				>
					<path
						fill-rule="evenodd"
						d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
						clip-rule="evenodd"
					/>
				</svg>
				<svg
					class="pointer-events-none col-start-1 row-start-1 mr-3 self-center justify-self-end shrink-0 size-4 animate-spin"
					xmlns="http://www.w3.org/2000/svg"
					fill="none"
					viewBox="0 0 24 24"
					aria-hidden="true"
					data-slot="icon"
					x-show="show_loader"
				>
					<circle
						class="opacity-25"
						cx="12"
						cy="12"
						r="10"
						stroke="currentColor"
						stroke-width="4"
					></circle>
					<path
						class="opacity-75"
						fill="currentColor"
						d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
					></path>
				</svg>
			</form>

			<!-- Results, show/hide based on command palette state -->
			<ul
				class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800"
				id="options"
				role="listbox"
				wire:show="show_results"
			>
				<!-- Active: "bg-indigo-600 text-white outline-hidden" -->
				@forelse ($cities as $city)
					<li
						class="cursor-pointer px-4 py-2 select-none hover:bg-indigo-600 hover:text-white"
						id="option-1"
						role="option"
						tabindex="-1"
						x-on:click="
                            city = '{{ $city->name ?? '' }} {{ isset($city->admin1) ? '(' . $city->admin1 . ')' : '' }}';
                            city_search.show = false;

                            $refs.input.value = '';
                            $wire.cities = []
                            $wire.show_results = false

                            weather = null;
                            weather = await (await fetch('/api/weather?lat={{ $city->latitude }}&lon={{ $city->longitude }}')).json();
                        "
					>{{ $city->name ?? '' }} {{ isset($city->admin1) ? '(' . $city->admin1 . ')' : '' }}</li>
				@empty
					<li>
						<!-- Empty state, show/hide based on command palette state -->
						<p class="p-4 text-sm text-gray-500">No cities found.</p>
					</li>
				@endforelse
			</ul>
		</div>
	</div>
</div>
