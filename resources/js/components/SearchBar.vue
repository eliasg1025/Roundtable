<template>
	<div class="searchBar">
		<input type="text" placeholder="Busca alguna empresa" name="search" class="input-search">
		<button class="search-icon">
			<img src="https://img.icons8.com/cotton/24/000000/search--v2.png">
		</button>
	</div>
</template>

<script>
	export default {
		name: 'search-bar'
	}
</script>

<style>
	button .search-icon img{
		transition: transform .25s;
	}

	button .search-icon img:hover {
		transform: scale(1.2);
	}

	.searchBar {
		height: 60px;
		width: 100%;
	    max-width: 100%;
	    background: white;
	    border-radius: 10px;
	    left: 0;
	    right: 0;
		display: flex;
		margin: 40px 0;
		box-shadow: 0 0 1px 1px #88BE2E;
	}

	.input-search {
		border: none;
		width: 100%;
		border-radius: 10px;
		padding: 30px;
	}

	.search-icon {
		padding: 16px;
		background: transparent;
		border: none;
		cursor: pointer;
	}
</style>
