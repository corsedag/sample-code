<x-layout>
	{{-- navigation bar --}}
	<x-navbar />

	{{-- content area --}}
	<div class="w-full grow max-w-7xl mx-auto py-10 px-2 sm:px-6 lg:px-8">
		{{-- header --}}
		<x-header />

		{{-- search for a city --}}
		<livewire:city-search />

		{{-- main content --}}
		<x-main-content>
			<div
				x-init="weather = await (await fetch('/api/weather')).json()"
				class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4 sm:mt-8"
			>
				<x-card
					label="Current Temperature"
					id="current-temperature"
					unit="&deg;"
					path="current.temperature_2m"
				/>

				<x-card
					label="Current Condition"
					id="current-condition"
					path="current.description"
				/>

				<x-card
					label="Humidity"
					id="current-humidity"
					unit="%"
					path="current.relative_humidity_2m"
				/>

				<x-card
					label="Wind Speed"
					id="current-wind-speed"
					unit=" mph"
					path="current.wind_speed_10m"
				/>
			</div>
		</x-main-content>
	</div>

	{{-- footer --}}
	<x-footer />
</x-layout>
