<!DOCTYPE html>
<html
	lang="en"
	class="h-full"
>

<head>
	<meta charset="UTF-8">
	<title>Weather</title>

	<!-- Fonts -->
	<link
		rel="preconnect"
		href="https://fonts.bunny.net"
	>
	<link
		href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
		rel="stylesheet"
	/>

	<!-- Styles / Scripts -->
	@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
		@vite(['resources/css/app.css', 'resources/js/app.js'])
	@endif
</head>

<body
	x-data="{ 
		city: 'Pittsburgh (Pennsylvania)',
		navbar: false,
		weather: null,
		city_search: {
			loading: false,
			show: false,
		}
	}"
	class="h-full bg-gray-50"
>
	<template x-if="true">
		<div class="min-h-full flex flex-col">
			{{ $slot }}
		</div>
	</template>

	@livewireScripts
</body>

</html>
