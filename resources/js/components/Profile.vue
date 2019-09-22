<template>
	<section class="user_profile">
		<div class="container">
			<div class="row mt-5">
				<div class="adv jumbotron jumbotron-fluid">
					<div class="row container">
						<div class="col-md-5 text-center">
							<img src="/img/group.png" alt="" height="200px">
						</div>
						<div class="col-md-7">
							<h2 class="display-4">Bienvenido!</h2>
							<p class="lead">Descubre todos los beneficios incluidos en el plan Premium Business</p>
							<a href="/planes" class="btn">
								<span class="lead">
									Ir a planes <i class="fa fa-angle-double-right"></i>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row align-items-center text-center">
				<div class="container mb-3">
					<a :href="'/business/profile/' + user.uuid" target="_blank" class="btn btn-success btn-lg btn-view-profile">
						Visualizar Perfil
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<!-- Box Profile -->
					<div class="box-profile-img">
						<!-- Profile Logo -->
						<div class="head">
							<img :src="user.profile_img" width="100%">
						</div>
						<!-- Info -->
						<div class="body" style="font-weight: 600;">
							<rating-stars
								:amount_rating="rating.amount"
								:avg_rating="rating.value"
								:show_number="true"
								class="text-center"
							>
							</rating-stars>
							<h4 class="text-center">{{ user.commercial_name }}</h4>
							<hr>
							<ul class="notifications">
								<li class="align-top">
									<div class="p-1">
										<a
											tabindex="0"
											role="button"
											data-toggle="popover"
											data-trigger="focus"
											data-content="And here's some amazing content. It's very engaging. Right?"
										>
											Tienes <span class="badge badge-success">{{user.coins}} coins</span>
										</a>
									</div>
								</li>
								<li class="align-top">
									<div class="p-1">
										<a
											tabindex="0"
											role="button"
											data-toggle="popover"
											data-trigger="focus"
											data-content="And here's some amazing content. It's very engaging. Right?"
										>
											Notificaciones <span class="badge badge-info">{{ messages.length }}</span>
										</a>
									</div>
								</li>
								<li class="align-top">
									<div class="p-1">
										<a
											tabindex="0"
											role="button"
											data-toggle="popover"
											data-trigger="focus"
											data-content="And here's some amazing content. It's very engaging. Right?"
										>
											Plan Actual <span class="badge badge-secondary">{{ current_plan.name }}</span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- End Box Profile -->
					<ul v-show="active" class="lateral-user-options mt-3">
						<!-- Info Empresa -->
						<li>
							<div>
								<button v-on:click.stop.prevent="activePanel(1)" class="btn" href="#">
									<h5>Información Empresa</h5>
								</button>
							</div>
						</li>
						<!-- Ofertas -->
						<li>
							<div>
								<button v-on:click.stop.prevent="activePanel(2)" class="btn" href="#">
									<h5>Ofertas</h5>
								</button>
							</div>
						</li>
						<!-- Certificaciones -->
						<li>
							<div>
								<button v-on:click.stop.prevent="activePanel(3)" class="btn" href="#">
									<h5>Certificaciones</h5>
								</button>
							</div>
						</li>
						<!-- Agendamientos -->
						<li>
							<div>
								<button v-on:click.stop.prevent="activePanel(4)" class="btn" href="#">
									<h5>Agendamientos</h5>
								</button>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-sm-9 col-md-9">
					<!-- User Options -->
					<ul id="userPanel" v-show="!active" class="user-options">
						<!-- Info Empresa -->
						<li>
							<figure class="snip green">
								<img src="/img/accounting-businesswoman-communication-38556 (1).jpg" alt=""/>
								<figcaption>
									<div>
										<span>Información Empresa</span>
									</div>
									<div>
										<h5>Información Empresa</h5>
									</div><a v-on:click.stop.prevent="activePanel(1)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Ofertas -->
						<li>
							<figure class="snip green">
								<img src="/img/food-berries-wallpaper-44416-45541-hd-wallpapers_1400_820.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Ofertas</span>
									</div>
									<div>
										<h5>Ofertas</h5>
									</div><a v-on:click.stop.prevent="activePanel(2)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Certificaciones -->
						<li>
							<figure class="snip green">
								<img src="/img/-cual-es-el-fruto-seco-mas-saludable-1-655x368.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Certificaciones</span>
									</div>
									<div>
										<h5>Certificaciones</h5>
									</div><a v-on:click.stop.prevent="activePanel(3)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Agendamientos -->
						<li>
							<figure class="snip green">
								<img src="/img/body-language-business-etiquette-businesspeople-1179804.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Agendamiento</span>
									</div>
									<div>
										<h5>Agendamiento</h5>
									</div><a v-on:click.stop.prevent="activePanel(4)" href="#"></a>
								</figcaption>
							</figure>
						</li>
					</ul>
					<!-- End User Options -->

					<!-- Informacion Empresa Panel -->
					<div v-show="panel === 1">
						<h3>Información Empresa</h3>
					</div>
					<!-- End Panel -->

					<!-- Ofertas Panel -->
					<div v-show="panel === 2">
						<h3>Ofertas</h3>
					</div>
					<!-- End Panel -->
					
					<!-- Certificaciones Panel -->
					<div v-show="panel === 3">
						<h3>Certificaciones</h3>
					</div>
					<!-- End Panel -->
					
					<!-- Agendamientos Panel -->
					<div v-show="panel === 4">
						<h3>Agendamientos</h3>
					</div>
					<!-- End Panel -->
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	$(function () {
  		$('[data-toggle="popover"]').popover()
	});

	export default {
		props: [
			'data',
		],
		data() {
			return {
				'user': this.data.user,
				'user_plans': this.data.user_plans,
				'messages': this.data.messages,
				'rating': this.data.account_data.rating_data,
				'current_plan': this.data.user_plans[0],
				// Panel state
				'active': false,
				'panel': 0,
			}
		},
		methods: {
			activePanel(option) {

				if (this.active === false) {
					this.active = true
				}

				this.panel = option
			}
		}
	}
</script>

<style>
	.btn-view-profile {
		font-family: 'Poppins', sans-serif;
		text-transform: uppercase;
		font-size: 1.1rem;
		width: 380px;
		float: right;
		background-color: rgb(136, 190, 46);
		border-color: rgb(136, 190, 46);
		transition: all 0.6s;
		color: #fff;
	}

	.btn-view-profile:hover {
		background-color: rgba(136, 190, 46, 0.9);
		border-color: rgba(136, 190, 46, 0.9);
		margin-right: 20px;
		transition: all 0.6s;
		color: #fff;
	}

	@media (max-width: 600px) {
		.btn-view-profile {
			width: 80%;
			float: none;
		}
	}

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
		margin: 25px 0 5px 0;
	}

	.notifications {
		list-style: none;
		text-align: center;
		margin-bottom: 5px;
	}

	.notifications li a {
		color: #212529;
		transition: ease 0.5s;
	}

	.notifications li a:hover {
		transition: all 0.3s;
		color: #88be2e;
		margin-left: 10px;
		cursor: pointer;
	}

	/* User options */

	.user-options {
		display: flex;
		flex-flow: row wrap;
		border-bottom: 0;
		list-style: none;
		padding-left: 0;
		margin-bottom: 0;
	}

	.user-options > li {
		width: 45%;
		margin: 0 auto;
		border-radius: 15px;
	}

	@media (max-width: 600px) {
		.user-options > li {
			width: 100%;
		}
	}

	figure.snip {
		font-family: 'Poppins', sans-serif;
		font-weight: 600;
		color: #fff;
		position: relative;
		overflow: hidden;
		min-width: 220px;
		max-width: 400px;
		height: 205px;
		width: 100%;
		background: #000000;
		text-align: center;
		border-radius: 15px;
		box-shadow: 0px 0px 5px 5px #ececec;
	}

	figure.snip * {
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-transition: all 0.3s;
		transition: all 0.3s;
	}

	figure.snip img {
		opacity: 1;
		width: 100%;
		height: 100%;
		-webkit-transition: all 0.6s;
		transition: all 0.6s;
	}

	figure.snip figcaption {
		position: absolute;
		bottom: 0;
		left: 18%;
		right: 18%;
		height: 100%;
	}

	figure.snip figcaption > div {
		overflow: hidden;
		width: 100%;
		position: relative;
		height: 50%;
	}

	figure.snip h5,
	figure.snip span {
		margin: 0;
		padding: 10px 15px;
		display: inline-block;
		width: 100%;
		font-weight: 700;
	}

	figure.snip span {
		background: rgba(256, 256, 256, 1);
		color: #4d4d4d;
		position: relative;
		bottom: 0;
		left: 0;
		position: absolute;
		-webkit-transform: translate3d(0%, 100%, 0);
		transform: translate3d(0%, 100%, 0);
		border-radius: 5px;
	}

	figure.snip h5 {
		background: rgba(51, 51, 51, 0.5);
		-webkit-transform: translate3d(0%, 0%, 0);
		transform: translate3d(0%, 0%, 0);
		border-radius: 5px;
		font-size: 17px;
	}

	figure.snip a {
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		position: absolute;
		color: #ffffff;
	}

	figure.snip.blue {
		background: #0a212f;
	}

	figure.snip.blue h5 {
		background: #2980b9;
	}

	figure.snip.red {
		background: #36100c;
	}

	figure.snip.red h5 {
		background: #c0392b;
	}

	figure.snip.yellow {
		background: #583804;
	}

	figure.snip.yellow h5 {
		background: #f39c12;
	}

	figure.snip.navy {
		background: #000000;
	}

	figure.snip.navy h5 {
		background: #34495e;
	}

	figure.snip:hover img,
	figure.snip.hover img {
		opacity: 0.35;
		-webkit-filter: blur(5px);
		filter: blur(5px);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	figure.snip:hover figcaption span,
	figure.snip.hover figcaption span {
		-webkit-transform: translate3d(0%, 0%, 0);
		transform: translate3d(0%, 0%, 0);
	}

	figure.snip:hover figcaption h5,
	figure.snip.hover figcaption h5 {
		-webkit-transform: translate3d(0%, -100%, 0);
		transform: translate3d(0%, -100%, 0);
	}

	.adv {
		width: 100%;
	}

	.adv a {
		color: #fff;
		background-color: rgb(136, 190, 46);
		transition: all 0.6s;
	}

	.adv a:hover {
		color: #fff;
		transform: scale(1.2);
		transition: all 0.6s;
	}

	/* Lateral User Options */

	.lateral-user-options {
		list-style: none;
	}

	.lateral-user-options figure.snip {
		height: 100px !important; 
	}
</style>
