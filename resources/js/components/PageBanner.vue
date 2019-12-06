<template>
	<section :id="this.id" class="pageBanner">
		<div class="container">
			<div class="row row_heigth">
				<div class="col-md-12">
					<h2 class="title-page">{{ this.title }}</h2>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	props: ["title", "img"],
	data() {
		return {
			id: this.title.replace(/ |:|,|'|.|°/gi, "-")
		};
	},
	mounted() {
		let el = document.querySelector(`#${this.id}`);
		el.style = `background-image: url('${this.img}');`;
	}
};
</script>

<style>
.pageBanner {
	padding: 100px 0 100px 0;
	background-size: cover;
	background-position: center;
	position: relative;
}

.pageBanner:before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: 0.3;
}

.row_heigth {
	height: 150px;
	align-items: flex-end;
}

.title-page {
	font-family: "Roboto", sans-serif;
	color: #fff;
	font-weight: 600;
	text-transform: uppercase;
}
</style>
