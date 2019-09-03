<template>
	<section class="user_profile">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-sm-3 col-md-3">
					<div class="box-profile-img">
						<div class="head">
							<img :src="this.user_data.profile_img" width="100%">
						</div>
						<div class="body" style="font-weight: 600;">
							<h4 class="text-center">{{ this.user_data.name }}</h4>
						</div>
					</div>
				</div>
				<div class="col-sm-9 col-md-9">
					
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: ['user_data']
	}
</script>

<style>
	.user_profile {
		padding: 50px 0;
    	background: #f1f1f1;
	}

	.box-profile-img {
	    padding: 10px;
    	background: #fff;
    	box-shadow: 0px 0px 5px 5px #ececec;
    	border-radius: 10px;
	}

	.box-profile-img .head {
		padding: 10px;
	}

	.box-profile-img .body {
		margin: 25px 0;
	}
	
</style>