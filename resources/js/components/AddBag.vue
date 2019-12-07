<template>
	<section>
		<div>
			<a
				:href="'/pagos/coin_packs/' + slug"
				class="b1 btn btn-primary card-text"
				>Adquirir</a
			>
		</div>
	</section>
</template>

<script>
export default {
	name: "Add-Bag",
	props: {
		cantidad: "",
		cost: "",
		slug: ""
	},
	data() {
		return {
			items: {
				cantidad: this.cantidad,
				price: this.cost
			}
		};
	},
	methods: {
		addBag() {
			window.location.href = "/planes/pagos";
			this.$store.commit("addBag", this.items);
		}
	}
};
</script>

<style>
/*href="/planes/pagos" target="_blank" */
div > .b1 {
	background: linear-gradient(
		to right,
		#88be2e 0%,
		rgb(143, 214, 110) 51%,
		#aae747 100%
	);
	transition: 0.5s;
	background-size: 200% auto;
	border: none;
	color: white;
	padding: 7px 15px;
	text-align: center;
	text-decoration: none;
	font-size: 15px;
	font-family: "Nunito", sans-serif;
	border-radius: 3px;
	width: 60%;
}

.b1:hover {
	background-position: right center;
	color: rgb(243, 245, 245);
}
</style>
