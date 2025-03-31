<div class="bg-white p-8 rounded-lg shadow flex flex-col">
	<p
		:aria-labelledby="$id"
		class="text-xs text-gray-500 uppercase grow mb-2.5"
	>
		{{ $label }}
	</p>

	<p
		:id="$id"
		class="text-2xl"
		x-show="weather"
	>
		<span
			x-show="_.has(weather, '{{ $path }}')"
			x-text="_.get(weather, '{{ $path }}') + '{!! $unit !!}'"
		></span>

		<span
			x-show="!_.has(weather, '{{ $path }}')"
			class="text-gray-300"
		>
			Not Available
		</span>
	</p>

	{{-- skeleton loader --}}
	<div
		class="h-6 w-20 rounded-full bg-gray-100 animate-pulse"
		x-show="!weather"
	></div>
</div>