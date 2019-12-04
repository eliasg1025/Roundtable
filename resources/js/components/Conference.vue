<template>
	<div>
		<h2>Video</h2>
		<div class="video-grid" id="video">
			<div class="video-view">
				<div id="local_stream" class="video-placeholder"></div>
				<div id="local_video_info" class="video-profile hide"></div>
				<div
					id="video_autoplay_local"
					class="autoplay-fallback hide"
				></div>
			</div>
		</div>
	</div>
</template>

<script>
import "../agora";

export default {
	mounted() {}
};
</script>

<style></style>
