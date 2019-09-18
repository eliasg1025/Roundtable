<template>
	<div class="business-card-container container p-3">
		<div class="card">
			<div class="view-overlay">
				<img :src="company.cover_img" alt="" class="" style="width:100%; height:150px;">
			</div>
			<div class="card-body row">
				<div class="business-card-logo-container col-5 p-0">
					<img :src="company.profile_img" alt="" style="width:100%;" class="img-profile">
				</div>
				<div class="col-7">
					<h6 class="card-title">
						<a href="">{{company.commercial_name}}</a>
					</h6>

					<rating-stars
						:amount_rating="company.amount_rating"
						:avg_rating="company.avg_rating"
						:show_number="true"
					>
					</rating-stars>

					<a :href="'business/profile/' + company.uuid"  v-if="loged == true">
						<button class="btn btn-outline-success">
							Ver más
						</button>
					</a>
					<a href="#" class="have-to-login" data-toggle="modal" data-target="#login" v-else>
						<button class="btn btn-outline-success">
							Ver más
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: 'card-business',
	props: ['company', 'loged'],
};
</script>

<style>

</style>
