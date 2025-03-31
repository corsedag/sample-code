<header class="">
	<div class="flex items-center">
		<h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-600">Current Weather for
			<span
				x-on:click="
					city_search.show = true;
					setTimeout(() => { 
						document.getElementById('search-input')?.focus()
					}, 50);
				"
				class="underline-offset-4 underline decoration-dotted decoration-gray-400 hover:text-gray-950 cursor-pointer"
				x-text="city"
			></span>
		</h1>
	</div>
</header>
