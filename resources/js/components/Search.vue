<template>
	<main>
		<page-banner :title="title" :img="img">
		</page-banner>

		<section class="search-category-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="row">
							<div class="col">
								<search-bar></search-bar>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<search-grid
									:users="users"
									:loged="loged"
								></search-grid>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<search-category-sidebar
							:data="categories"
						></search-category-sidebar>
					</div>
				</div>
			</div>
		</section>
	</main>
</template>

<script>
	export default {
		name: 'search',
		props: ['title', 'img', 'loged'],
		data() {
			return {
				users: '',
				categories: '',
			}
		},
		mounted() {
			axios.get('api/business')
				.then(res => {
					this.users = res.data.users;
					this.categories = res.data.categories;
				})
				.catch(err => {
					console.log(err);
				})
		}
	}
</script>

<style>
	.search-category-section {
		padding: 20px 0px 50px 0px;
	}
</style>
