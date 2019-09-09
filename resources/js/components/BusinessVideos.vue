<template>
	<section class="businessVideos">
		<div class="container businessVideos-container">
			<h2 class="title-businessVideos">Conoce a la empresa</h2>

			<div id="carousel-business-videos">
				<div v-for="video in data_videos">
					<video controls class="business-video d-block w-100">
						<source :src="video.url">
					</video>
				</div>
			</div>

			<div id="carousel-business-controls" class="text-center">
				<span class="thumbnail-item" style="margin-right: 5px;">
					<a class="btn btn-control">
						<img src="/img/angle-left.png" alt="">
						<span style="color: #6d6d6d">Anterior</span>
					</a>
				</span>
				<span class="thumbnail-item" style="margin-left: 5px;">
					<a class="btn btn-control">
						<span style="color: #6d6d6d">Siguiente</span>
						<img src="/img/angle-right.png" alt="">
					</a>
				</span>
			</div>

		</div>
	</section>
</template>

<script>
export default {
	name: "business-videos",
	props: ['data_videos'],
	mounted() {
		const slider_business_videos = Tiny.tns({
			container: '#carousel-business-videos',
			items: 1,
			autoplay: false,
			controlsContainer: '#carousel-business-controls',
		});
	},
	created() {
		console.log(this.data_videos);
	}
};
</script>

<style>
	.businessVideos {
		padding: 80px 0 0 0;
		position: relative;
		background-color: rgb(230, 230, 230);
	}

	.title-businessVideos {
		font-family: 'Roboto', sans-serif;
		margin-bottom: 25px;
		text-align: center;
	}

	#carousel-business-controls {
		margin-top: 15px;
	}

	.businessVideos-container {
		width: 1000px;
	}

	@media (max-width: 1000px) {
		.businessVideos-container {
			width: 100%;
		}
	}

	.btn-control {
		font-family: 'Roboto', sans-serif;
		text-transform: uppercase;
		cursor: pointer;
	}

	.btn-control:hover {
		background-color: #cecece;
	}
</style>
