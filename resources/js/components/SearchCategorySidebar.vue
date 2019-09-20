<template>
	<div class="searchSideBar">
		<div class="card-header text-white text-uppercase title-sidebar">
			<i class="fa fa-list"></i> Categorias
		</div>
		<div class="list-group">
			<a v-on:click.stop.prevent="setCategoryUrl(category.slug)" href="#" class="list-group-item item-siderbar" v-for="(category, index) in data" :key="index">
				<span style="margin-right: 10px;"><img :src="category.picture" alt="" height="30px"></span>
				{{ category.name }}
			</a>
		</div>
	</div>
</template>

<script>
	import storeData from '../store/index'

	export default {
		name: 'search-category-sidebar',
		props: ['data'],
		methods: {
			setCategoryUrl(slug) {
				storeData.commit('modifyUrl', slug)
			}
		}
	}
</script>

<style>
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
