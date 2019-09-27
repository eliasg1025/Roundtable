<template>
	<section class="user_profile">
		<div class="container">
			<div class="row mt-3">
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
				<!-- Left side -->
				<div class="col-md-3">
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
							<ul class="notifications container">
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#">
											Plan Actual <span class="badge badge-secondary">{{ current_plan.name }}</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#">
											Tienes <span class="badge badge-success">{{user.coins}} coins</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#">
											Visitas <span class="badge badge-success">{{ user.views }}</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#">
											Notificaciones <span class="badge badge-success">{{ messages.length }}</span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- End Box Profile -->
					<div v-show="active" class="lateral-user-options mt-3">
						<!-- Menu Options -->
						<div class="card-header text-white text-uppercase title-sidebar">
							<i class="fa fa-list"></i> Menú
						</div>
						<div class="list-group">
							<a href="#" v-on:click.stop.prevent="activePanel(1)" class="list-group-item item-siderbar">Información Empresa</a>
							<a href="#" v-on:click.stop.prevent="activePanel(2)" class="list-group-item item-siderbar">Ofertas</a>
							<a href="#" v-on:click.stop.prevent="activePanel(3)" class="list-group-item item-siderbar">Certificaciones</a>
							<a href="#" v-on:click.stop.prevent="activePanel(4)" class="list-group-item item-siderbar">Agendamientos</a>
						</div>
					</div>
				</div>

				<!-- Rigth Side -->
				<div class="col-md-9">
					<!-- Top user Options -->
					<div class="top-user-options my-3">
						<div class="list-group list-group-horizontal row" v-show="active">
							<a href="#" v-on:click.stop.prevent="activePanel(1)" class="list-group-item item-topbar col-md-3"><div>Información Empresa</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(2)" class="list-group-item item-topbar col-md-3"><div>Ofertas</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(3)" class="list-group-item item-topbar col-md-3"><div>Certificaciones</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(4)" class="list-group-item item-topbar col-md-3"><div>Agendamientos</div></a>
						</div>
					</div>


					<!-- User Options -->
					<ul id="userPanel" v-show="!active" class="user-options">
						<!-- Info Empresa -->
						<li>
							<figure class="snip">
								<img src="/img/accounting-businesswoman-communication-38556 (1).jpg" alt=""/>
								<figcaption>
									<div>
										<span>Información Empresa</span>
									</div>
									<div>
										<h5>Información Empresa</h5>
									</div>
									<a v-on:click.stop.prevent="activePanel(1)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Ofertas -->
						<li>
							<figure class="snip">
								<img src="/img/food-berries-wallpaper-44416-45541-hd-wallpapers_1400_820.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Ofertas</span>
									</div>
									<div>
										<h5>Ofertas</h5>
									</div>
									<a v-on:click.stop.prevent="activePanel(2)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Certificaciones -->
						<li>
							<figure class="snip">
								<img src="/img/certificados/stock-photo-office-paper-document-stamp-in-business-human-hand-73802812-680x365_c.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Certificaciones</span>
									</div>
									<div>
										<h5>Certificaciones</h5>
									</div>
									<a v-on:click.stop.prevent="activePanel(3)" href="#"></a>
								</figcaption>
							</figure>
						</li>
						<!-- Agendamientos -->
						<li>
							<figure class="snip">
								<img src="/img/body-language-business-etiquette-businesspeople-1179804.jpg" alt=""/>
								<figcaption>
									<div>
										<span>Agendamiento</span>
									</div>
									<div>
										<h5>Agendamiento</h5>
									</div>
									<a v-on:click.stop.prevent="activePanel(4)" href="#"></a>
								</figcaption>
							</figure>
						</li>
					</ul>
					<!-- End User Options -->

					<section class="panels">
						<div class="spinner-container" v-show="loading">
							<spinner></spinner>
						</div>

						<!-- Informacion Empresa Panel -->
						<div class="panel" v-show="panel === 1">
							<panel-info
								:user="user"
								:media_data="media_data"
								:current_plan="current_plan"
							></panel-info>
						</div>

						<!-- Ofertas Panel -->
						<div class="panel" v-show="panel === 2">
							<panel-offer
								:data_offers="data_offers"
							></panel-offer>
						</div>

						<!-- Certificaciones Panel -->
						<div class="panel" v-show="panel === 3">
							<panel-cert
								:certifications="certifications"
							></panel-cert>
						</div>

						<!-- Agendamientos Panel -->
						<div class="panel" v-show="panel === 4">
							<panel-meet></panel-meet>
						</div>
					</section>

				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import PanelInfo from "./ProfilePanelInfo";
	import PanelOffer from "./ProfilePanelOffer";
	import PanelCert from "./ProfilePanelCert";
	import PanelMeet from "./ProfilePanelMeet";
	import Spinner from "./Spinner";

	export default {
		components: {
			PanelInfo,
			PanelOffer,
			PanelCert,
			PanelMeet
		},
		props: [
			'data',
		],
		data() {
			return {
				user: this.data.user,
				user_plans: this.data.user_plans,
				messages: this.data.messages,
				media_data: this.data.media_data,
				rating: this.data.account_data.rating_data,
				data_offers: this.data.account_data.offers_data,
				certifications: this.data.account_data.user_certifications,
				// Panel state
				active: false,
				panel: 0,
				loading: false,
			}
		},
		computed: {
			current_plan() {
				return this.user_plans[0]
			}
		},
		methods: {
			activePanel(option) {
				this.active = true
				this.panel = 0
				this.loading = true
				setTimeout(() => {
					this.panel = option
					this.loading = false
				}, 500)
			}
		},
		mounted() {
			$(function () {
				$('[data-toggle="popover"]').popover()
			});
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

	figure.snip {
		font-family: 'Poppins', sans-serif;
		font-weight: 600;
		color: #ececec;
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

	figure.snip h5, figure.snip span {
		margin: 0;
		padding: 10px 15px;
		display: inline-block;
		width: 100%;
		font-weight: 700;
	}

	figure.snip span {
		background: #88be2e;
		color: #fff; /*#4d4d4d*/
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

	figure.snip:hover img, figure.snip.hover img {
		opacity: 0.35;
		-webkit-filter: blur(5px);
		filter: blur(5px);
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	figure.snip:hover figcaption span, figure.snip.hover figcaption span {
		-webkit-transform: translate3d(0%, 0%, 0);
		transform: translate3d(0%, 0%, 0);
	}

	figure.snip:hover figcaption h5, figure.snip.hover figcaption h5 {
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
		display: none;
	}

	.item-topbar {
		color: black;
		transition: all ease 500ms;
		text-align: center;
		vertical-align: middle;
	}

	.item-topbar:hover {
		background-color:#E9ECEF;
		color: #88BE2E;
		margin-top: 1%;
		margin-bottom: -1%;
	}

	.panels {
		margin-top: 10px;
	}

	.panel {
		margin-top: 25px;
	}

	.spinner-container {
		margin-top: 50px;
	}

	@media screen and (max-width: 768px) {
		figure.snip {
			height: 180px;
		}

		.box-profile-img h4 {
			font-size: 16px;
		}

		.box-profile-img ul {
			font-size: 12px;
		}
	}

	@media (max-width: 600px) {
		.box-profile-img {
			margin-bottom: 35px;
		}

		.btn-view-profile {
			width: 80%;
			float: none;
		}

		.user-options > li {
			width: 100%;
		}

		.lateral-user-options {
			display: block;
		}

		.top-user-options {
			display: none;
		}

		.box-profile-img h4 {
			font-size: 26px;
		}

		.box-profile-img ul {
			font-size: 18px;
		}
	}
</style>
