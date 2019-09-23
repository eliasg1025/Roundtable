<template>
	<div>
		<div class="searchBar">
			<input
				v-model="query"
				v-on:keyup="autoComplete"
				type="text" placeholder="Busca alguna empresa" name="search" class="input-search"
				autocomplete="off"
			>
			<button class="search-icon">
				<img src="https://img.icons8.com/cotton/24/000000/search--v2.png">
			</button>
		</div>
		<div v-if="results.length" class="results panel-footer">
			<ul class="list-group">
				<a :href="'/business/profile/' + result.uuid" class="list-group-item" v-for="result in results" :key="result.id">
					<img :src="result.profile_img" height="30px" style="margin-right: 10px;"> {{ result.commercial_name }}
				</a>
			</ul>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'search-bar',
		data() {
			return {
				query: '',
				results: []
			}
		},
		methods: {
			autoComplete() {
				this.results = [];
				if (this.query.length > 2) {
					axios.get('api/business/search', {
						params: {query: this.query}
					})
						.then(res => {
							this.results = res.data
						})
				}
			}
		}
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

	.results a{
		color: black;
	}

	.results a:hover{
		color: #88BE2E
	}
</style>
