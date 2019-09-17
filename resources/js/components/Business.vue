<template>
	<main>
		<business-banner
			:data_user="data_user"
			:data_account="data_account"
		>
		</business-banner>

		<business-products
			:data_offers="data_account.offers_data"
		>
		</business-products>

		<business-videos
			:data_videos="data_media.videos"
		>
		</business-videos>

		<business-images
			:data_images="data_media.images"
		>
		</business-images>

		<page-footer></page-footer>

		<modal-login-register
			:csrf="csrf"
			:href_login="href_login"
			:href_register="href_register"
			:href_reset_password="href_reset_password"
		/>
	</main>
</template>

<script>
	export default {
		name: 'business',
		props: [
			'data_user',
			'data_media',
			'data_account',
			'csrf',
			'href_login',
			'href_register',
			'href_reset_password',
		]
	}
</script>

<style>

</style>
