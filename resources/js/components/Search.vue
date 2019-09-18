<template>
	<main>
		<page-banner :title="title" :img="img">
    	</page-banner>

    	<section class="search-category-section">
    		<div class="container">
    			<div class="row">
					<div class="col">
						<search-bar></search-bar>
					</div>
    			</div>
    			<div class="row">
    				<div class="col-lg-9">
    					<search-grid></search-grid>
    				</div>
    				<div class="col-lg-3">
    					<search-category-sidebar></search-category-sidebar>
    				</div>
    			</div>
    		</div>
    	</section>
	</main>
</template>

<script>
	export default {
		name: 'search',
		props: ['title', 'img'],
		data() {
			return {
				data: []
			}
		},
		mounted() {
			axios.get('api/business', {

			})
				.then(res => {
					this.data = res.data;
				})
		}
	}
</script>

<style>
	.search-category-section {
		padding: 50px 0;
	}
</style>
