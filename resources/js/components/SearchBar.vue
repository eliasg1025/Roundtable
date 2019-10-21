<template>
	<div>
		<div class="searchBar">
			<input
				v-model="query"
				v-on:keyup="autoComplete()"
				type="text" placeholder="Busca alguna empresa" name="search" class="input-search"
				autocomplete="off"
			>
			<button class="search-icon">
				<i class="fas fa-search"></i>
			</button>
		</div>
		<div class="results">
			<div v-if="loading == true" class="list-group">
				<p class="list-group-item"><i class="fas fa-spinner fa-spin"></i>&nbsp;Buscando</p>
			</div>
			<div v-else>
				<div class="list-group" v-if="results.length">
					<a :href="'/business/profile/' + result.uuid" class="list-group-item" v-for="result in results" :key="result.id">
						<img :src="result.profile_img" height="30px" style="margin-right: 10px;"> {{ result.commercial_name }}
					</a>
				</div>
				<div class="list-group" v-else-if="results.length <= 0 && searched == true">
					<p class="list-group-item text-muted"> No se encontró una empresa con ese nombre.</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'search-bar',
		data() {
			return {
				query: '',
				results: [],
				loading: false,
				searched: false,
			}
		},
		methods: {
			autoComplete() {
				this.results = [];
				this.loading = true;
				if (this.query.length > 2) {
					axios.get('api/business/search', {
						params: {query: this.query}
					})
						.then(res => {
							setTimeout(() => {
								this.results = res.data;
								this.loading = false;
								this.searched = true;
							}, 1000);
						})
				} else {
					this.loading = false;
					this.searched = false;
				}
			}
		}
	}
</script>

<style>
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
		outline: none;
	}

	.input-search:focus + button.search-icon {
		color: #88BE2E;
	}

	.search-icon {
		padding: 16px;
		background: transparent;
		border: none;
		cursor: pointer;
	}

	.results {
		position: absolute;
    	z-index: 100;
    	width: 97%;
		margin-top: -25px;
		box-shadow: 0px 1px 0px 0px rgba(0,0,0,0.5);
	}

	.results a{
		color: black;
	}

	.results a:hover{
		color: #88BE2E
	}
</style>
