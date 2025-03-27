<x-layout>
	{{-- navigation bar --}}
	<x-navbar />

	{{-- content area --}}
	<div class="w-full grow max-w-7xl mx-auto py-10 px-2 sm:px-6 lg:px-8">
		{{-- header --}}
		<x-header>
			<h1 class="text-xl sm:text-2xl md:text-3xl font-bold">Current Weather for Raleigh, NC</h1>
		</x-header>

		{{-- main content --}}
		<x-main-content>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4 sm:mt-8">
				{{-- current temperatue card --}}
				<x-card>
					<p
						aria-labelledby="current-temperature"
						class="text-xs text-gray-500 uppercase"
					>Current Temperature</p>
					<p
						id="current-temperature"
						class="mt-4 text-2xl"
					><span>72</span>&deg;</p>
				</x-card>

				{{-- current conditions card --}}
				<x-card>
					<p
						aria-labelledby="current-condition"
						class="text-xs text-gray-500 uppercase"
					>Current Condition</p>
					<p
						id="current-condition"
						class="mt-4 text-2xl"
					>
						<span>Sunny</span>
					</p>
				</x-card>

				{{-- current humidity card --}}
				<x-card>
					<p
						aria-labelledby="current-humidity"
						class="text-xs text-gray-500 uppercase"
					>Humidity</p>
					<p
						id="current-humidity"
						class="mt-4 text-2xl"
					><span>47</span>%</p>
				</x-card>

				{{-- current wind speed card --}}
				<x-card>
					<p
						aria-labelledby="current-wind-speed"
						class="text-xs text-gray-500 uppercase"
					>Wind Speed</p>
					<p
						id="current-wind-speed"
						class="mt-4 text-2xl"
					><span>11</span> mph</p>
				</x-card>
			</div>
		</x-main-content>
	</div>

	{{-- footer --}}
	<x-footer />
</x-layout>
