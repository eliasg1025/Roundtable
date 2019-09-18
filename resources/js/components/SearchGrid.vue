<template>
	<div class="searchGrid row">
		<div v-for="(company, index) in users.data" :key="company.id" class="grid-element col-md-6">
			<card-business
				:company="company"
				:loged="loged"
			></card-business>
		</div>
		<nav class="w-100 mt-4">
			<ul class="pagination justify-content-center">
				<li class="page-item" :class="{ 'disabled':  users.prev_page_url == null}">
					<a
						v-on:click.stop.prevent="getUsers(users.prev_page_url)"
						class="page-link" href="#"
					>
						Anterior
					</a>
				</li>
				<li class="page-item"
					v-for="(page, index) in users.last_page" :key="index"
					v-bind:class="{'active': users.current_page - 1 == index}"
				>
					<a v-on:click.stop.prevent="getUsers(`api/business?page=${page}`)" class="page-link" href="#">{{ page }}</a>
				</li>
				<li class="page-item" :class="{ 'disabled':  users.next_page_url == null}">
					<a
						v-on:click.stop.prevent="getUsers(users.next_page_url)"
						class="page-link" href="#">
						Siguiente
					</a>
				</li>
			</ul>
		</nav>
	</div>
</template>

<script>
	export default {
		name: 'search-grid',
		props: ['loged'],
		data() {
			return {
				users: '',
			}
		},
		mounted() {
			axios.get('api/business')
				.then(res => {
					this.users = res.data;
				})
				.catch(err => {
					console.log(err);
				});
		},
		methods: {
			getUsers(url) {
				axios.get(url)
					.then(res => {
						this.users = res.data;
					})
			}
		}
	}
</script>

<style>
	.searchGrid {
		padding: 10px 0px 40px 0px;
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
</style>
