<template>
	<div class="searchGrid row">
		<div v-for="(company, index) in users.data" :key="index" class="grid-element col-md-6">
			<card-business
				:company="company"
				:loged="loged"
			></card-business>
		</div>
		<nav class="w-100 mt-4">
			<ul class="pagination justify-content-center">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
				</li>
				<li class="page-item"
					v-for="(page, index) in users.last_page" :key="index"
					v-bind:class="{'active': users.current_page - 1 == index}"
				>
					<a class="page-link" href="#">{{ page }}</a>
				</li>
				<li class="page-item">
					<a class="page-link" href="#">Siguiente</a>
				</li>
			</ul>
		</nav>
	</div>
</template>

<script>
	export default {
		name: 'search-grid',
		props: ['users', 'loged'],
		data() {
			return {
				data: ''
			}
		},
		mounted() {
			this.data = this.users
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
