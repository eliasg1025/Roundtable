<template>
	<section v-if="data_images.length > 0" class="businessImages">
		<div class="container text-center">
			<div
				id="carousel-business-images"
				class="carousel slide carousel-fade text-center"
			>
				<div class="carousel-inner">
					<div class="carousel-item active" data-side-number="0">
						<img :src="firstImage.url" class="img-fluid" />
					</div>

					<div
						class="carousel-item"
						:data-slide-number="index + 1"
						v-for="(image, index) in otherImages"
						:key="index + 1"
					>
						<img :src="image.url" class="img-fluid" />
					</div>

					<a
						class="carousel-control-prev"
						href="#carousel-business-images"
						role="button"
						data-slide="prev"
					>
						<span
							class="carousel-control-prev-icon"
							aria-hidden="true"
						></span>
						<span class="sr-only">Previous</span>
					</a>
					<a
						class="carousel-control-next"
						href="#carousel-business-images"
						role="button"
						data-slide="next"
					>
						<span
							class="carousel-control-next-icon"
							aria-hidden="true"
						></span>
						<span class="sr-only">Next</span>
					</a>
				</div>

				<ul class="carousel-indicators list-inline mx-auto border px-2">
					<li class="list-inline-item active">
						<a
							id="carousel-selector-0"
							class="selected"
							data-slide-to="0"
							data-target="#carousel-business-images"
						>
							<img
								:src="firstImage.url"
								style="width: 80px; height: 60px;"
								class="img-fluid"
							/>
						</a>
					</li>
					<li
						class="list-inline-item"
						v-for="(image, index) in otherImages"
						:key="index"
					>
						<a
							:id="'carousel-selector-' + index + 1"
							:data-slide-to="index + 1"
							data-target="#carousel-business-images"
						>
							<img
								:src="image.url"
								style="width: 80px; height: 60px;"
								class="img-fluid"
							/>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	name: "business-images",
	props: ["data_images"],
	data() {
		return {
			firstImage: {},
			otherImages: [...this.data_images]
		};
	},
	created() {
		this.firstImage = this.otherImages.shift();
	}
};
</script>

<style>
.businessImages {
	padding: 50px 0;
	position: relative;
	background-color: rgb(230, 230, 230);
}

#carousel-business-images {
	width: 1000px;
	margin: auto;
}

@media (max-width: 1000px) {
	#carousel-business-images {
		width: 100%;
	}
}

#carousel-business-images .list-inline {
	white-space: nowrap;
	overflow-x: auto;
}

#carousel-business-images .carousel-indicators {
	position: static;
	left: initial;
	width: initial;
	margin-left: initial;
}

#carousel-business-images .carousel-indicators > li {
	width: initial;
	height: initial;
	text-indent: initial;
}
</style>
