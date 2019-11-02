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
								<!-- Card Grid -->
								<div class="searchGrid">
									<!-- Spinner -->
									<div class="" v-show="loading">
										<spinner></spinner>
									</div>
									<!-- Title category -->
									<div
										v-if="category_title !== ''"
										v-show="!loading"
										class="category_title p-3 row"
									>
										<h2 class="category_title__text">
											Categoría: <span>{{ category_title }}</span>
										</h2>
										<p style="margin-left: .5em;">
											<a v-on:click.stop.prevent="resetUrl()" href="#" class="badge badge-danger">Quitar</a>
										</p>
									</div>
									<!-- Business cards -->
									<div id="grids" class="row">
										<div v-for="(company) in users.data" :key="company.id" class="grid-element col-md-6">
											<card-business
												:company="company"
												:loged="data.loged"
											></card-business>
										</div>
									</div>

									<div v-if="users.data.length === 0" v-show="!loading" class="container">
										<div class="text-center py-4">
											<span class="text-muted h3">Aún no hay empresas en esta categoría</span>
										</div>
									</div>

									<!-- Pagination -->
									<nav class="w-100 mt-4">
										<ul class="pagination justify-content-center">
											<li class="page-item" :class="{ 'disabled':  users.prev_page_url == null}">
												<a
													v-on:click.stop.prevent="getUsers(users.prev_page_url)"
													class="page-link" href="#"
												>
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
											<li class="page-item"
												v-for="(page, index) in users.last_page" :key="index"
												v-bind:class="{'active': users.current_page - 1 == index}"
											>
												<a v-on:click.stop.prevent="getUsers(`${apiUrl}?page=${page}`)" class="page-link" href="#">{{ page }}</a>
											</li>
											<li class="page-item" :class="{ 'disabled':  users.next_page_url == null}">
												<a
													v-on:click.stop.prevent="getUsers(users.next_page_url)"
													class="page-link" href="#">
													<span aria-hidden="true">&raquo;</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
								<!-- End Card Grid -->
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<!-- Sidebar -->
						<div class="searchSideBar">
							<div class="card-header text-white text-uppercase title-sidebar">
								<i class="fa fa-list"></i> Categorias
							</div>
							<div class="list-group">
								<a
									v-on:click.stop.prevent="setCategoryUrl(category)"
									href="#" class="list-group-item item-siderbar"
									v-for="(category, index) in data.categories" :key="index"
								>
									<span style="margin-right: 10px;"><img :src="category.picture" alt="" height="30px"></span>
									{{ category.name }}
								</a>
							</div>
						</div>
						<!-- End Sidebar -->
					</div>
				</div>
			</div>
		</section>
	</main>
</template>

<script>
	import store from '../store/index.js'

	export default {
		name: 'search',
		props: [
			'title',
			'img',
			'data'
		],
		data() {
			return {
				users: {
					data: []
				},
				category_title: '',
				loading: false,
			}
		},
		computed: {
			apiUrl() {
				return store.state.apiUrl
			}
		},
		mounted() {
			axios.get(this.apiUrl)
				.then(res => {
					this.users = res.data;
				})
				.catch(err => {
					console.log(err.response);
				});
		},
		methods: {
			setCategoryUrl(category) {
				// Cambiar la variable de vuex
				store.commit('setApiUrl', category.slug)

				this.category_title = category.name

				// Voler a cargar los usuarios
				this.getUsers(store.state.apiUrl)
			},
			resetUrl() {
				store.commit('resetApiUrl')
				this.category_title = ''
				this.getUsers(store.state.apiUrl)
			},
			getUsers(url) {
				this.loading = true;
				const cards = document.getElementById('grids');
				cards.style = 'display: none;';

				setTimeout(() => {
					axios.get(url)
						.then(res => {
							this.users = res.data;
						})
						.then(res => {
							cards.style = '';
							this.loading = false;
						});
				}, 500);
			}
		}
	}
</script>

<style>
	.search-category-section {
		padding: 20px 0px 50px 0px;
	}

	/* Grid */

	.searchGrid {
		padding: 10px 0px 40px 0px;
	}

	.category_title {
		font-family: 'Roboto', sans-serif;
	}

	@media (max-height: 568px) {
		.category_title h2 {
			font-size: 22px;
		}
	}

	.page-link {
		color: #88BE2E;
	}

	.page-item.active .page-link {
		background-color: #88BE2E;
		border-color: #88BE2E;
	}

	.page-link:hover {
		color: #88BE2E;
	}

	#grids {
		transition: all ease 1000ms;
	}

	/* Sidebar */
	.searchSideBar {
		padding: 40px 0;
	}

	.title-sidebar {
		background-color: #88BE2E;
		font-family: 'Roboto', sans-serif;
	}

	.item-siderbar {
		color: black;
		transition: all ease 500ms;
	}

	.item-siderbar:hover {
		background-color:#E9ECEF;
		color: black;
		margin-left: -5%;
		margin-right: 5%;
	}
</style>
