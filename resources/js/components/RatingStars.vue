<template>
	<ul class="rating" v-if="show_rating === true">

		<li v-for="n in stars.rating_star" :key="n"><i class="fa fa-star rating-star"></i></li><!--
		--><li v-if="stars.half_rating_star === 1"><i class="fas fa-star-half-alt rating-star"></i></li><!--
		--><li v-for="m in stars.no_rating_star" :key="m + 5"><i class="fa fa-star no-rating-star"></i></li>
		<li v-if="show_number === true"><p class="text-muted">{{ value_rating }} ({{ amount_rating }}) <sup><i class="fas fa-info rating-info-icon" :data-tippy-content="'Basado en la puntuación de '+amount_rating+' usuarios'"></i></sup></p></li>
	</ul>
	<ul class="no-rating" v-else>
		<li><i class="fa fa-star no-rating-star"></i></li><!--
		--><li><i class="fa fa-star no-rating-star"></i></li><!--
		--><li><i class="fa fa-star no-rating-star"></i></li><!--
		--><li><i class="fa fa-star no-rating-star"></i></li><!--
		--><li><i class="fa fa-star no-rating-star"></i></li>
		
		<li><small><p class="text-muted">Sin valoración</p></small></li>
	</ul>
</template>

<script>
    
	export default {
		name: 'rating-stars',
		props: [
			'amount_rating',
			'avg_rating',
			'show_number',
		],
		data() {
			return {
				value_rating: 0,
				show_rating: false,
				stars: {
					rating_star: 0,
					half_rating_star: 0,
					no_rating_star: 5,
				}
			}
		},
		created() {
			this.value_rating = this.amount_rating >= 4 ? this.rounded_rating() : '-';
			this.show_rating = this.amount_rating >= 4 ? true : false;
			// Para imprimir la cantidad de estrellas
			this.stars.rating_star = parseInt(this.value_rating);
			this.stars.half_rating_star = this.value_rating % 1 !== 0 ? 1 : 0;
			this.stars.no_rating_star =  5 - (this.stars.rating_star + this.stars.half_rating_star);
		},
		mounted() {
            Tippy.default('[data-tippy-content]');
			this.$emit('value_rating', this.value_rating);
			this.$emit('show_rating', this.show_rating);
		},
		methods: {
			rounded_rating() {
				return Math.round(this.avg_rating * 2) / 2;
			},
			mounted() {
				tippy('[data-tippy-content]');
			}
		}
	}
</script>

<style>
	.rating, .no-rating {
    	list-style-type: none;
    	padding: 0;
		margin: 0;
	}

	.rating li, .no-rating li {
		display: inline-block;
	}

	.rating-star {
		color: #ffa000;
	}

	.no-rating-star {
		color: #cecece;
	}
	.rating-info-icon {
		cursor: pointer;
	}
</style>
