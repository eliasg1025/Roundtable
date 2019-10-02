<template>
	<section class="user_profile">
		<div class="container">
			<div class="row">
				<div class="adv jumbotron jumbotron-fluid">
					<div class="row container">
						<div class="col-md-5 text-center">
							<img class="welcome-img" src="/img/group.png" height="200px">
						</div>
						<div class="col-md-7">
							<div class="welcome-text">
								<h2 class="display-4 welcome-text__title">Bienvenido!</h2>
								<p class="lead welcome-text__message">Descubre todos los beneficios incluidos en el plan Premium Business</p>
								<a href="/planes" class="btn">
									<span class="lead welcome-text__message">
										Ir a planes <i class="fa fa-angle-double-right"></i>
									</span>
								</a>
							</div>
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
							<a href="#" data-toggle="modal" data-target="#modalNotiStars">
								<rating-stars
									:amount_rating="rating.amount"
									:avg_rating="rating.value"
									:show_number="true"
									class="text-center"
								>
								</rating-stars>
							</a>

							<h4 class="text-center">{{ user.commercial_name }}</h4>
							<hr>
							<ul class="notifications container">
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#" data-toggle="modal" data-target="#modalNotiPlan">
											Plan Actual <span class="badge badge-secondary">{{ current_plan.name }}</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#" data-toggle="modal" data-target="#modalNotiCoins">
											Tienes <span class="badge badge-success">{{user.coins}} coins</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#" data-toggle="modal" data-target="#modalNotiViews">
											Visitas <span class="badge badge-success">{{ user.views }}</span>
										</a>
									</div>
								</li>
								<li class="align-top d-flex justify-content-between align-items-center">
									<div class="p-1">
										<a href="#" data-toggle="modal" data-target="#modalNotiMessages">
											Notificaciones <span class="badge badge-success">{{ messages.length }}</span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- End Box Profile -->
					<div v-if="active" class="lateral-user-options mt-3">
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
						<div class="list-group list-group-horizontal row" v-if="active">
							<a href="#" v-on:click.stop.prevent="activePanel(1)" class="list-group-item item-topbar col-md-3"><div>Información Empresa</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(2)" class="list-group-item item-topbar col-md-3"><div>Ofertas</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(3)" class="list-group-item item-topbar col-md-3"><div>Certificaciones</div></a>
							<a href="#" v-on:click.stop.prevent="activePanel(4)" class="list-group-item item-topbar col-md-3"><div>Agendamientos</div></a>
						</div>
					</div>


					<!-- User Options -->
					<ul id="userPanel" v-if="!active" class="user-options">
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
						<div class="panel" v-if="panel === 1">
							<panel-info
								:user="user"
								:media_data="media_data"
								:current_plan="current_plan"
								:categories_data="categories_data"
							></panel-info>
						</div>

						<!-- Ofertas Panel -->
						<div class="panel" v-if="panel === 2">
							<panel-offer
								:data_offers="data_offers"
							></panel-offer>
						</div>

						<!-- Certificaciones Panel -->
						<div class="panel" v-if="panel === 3">
							<panel-cert
								:certifications="certifications"
							></panel-cert>
						</div>

						<!-- Agendamientos Panel -->
						<div class="panel" v-if="panel === 4">
							<panel-meet></panel-meet>
						</div>
					</section>

				</div>
			</div>
		</div>

		<!-- Modal Notifications -->

		<!-- Modal Noti Stars -->
		<div class="modal fade" id="modalNotiStars" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container d-flex">
							<button type="button" data-dismiss="modal" class="close" aria-label="Close" style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="text-center">
							<h5 class="modal-title h3" id="modalStats-rating">Valoración</h5>
							<p class="display-4">{{ value_rating }} / 5</p>
						</div>

						<div class="rating-stars-modal container text-center">
							<rating-stars
								:amount_rating="rating.amount"
								:avg_rating="rating.value"
								:show_number="false"
								@value_rating="value_rating = $event"
								@show_rating="show_rating  = $event"
							>
							</rating-stars>
						</div>
						<div class="text-center">
							<p v-if="show_rating == true" class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Basados en la calificación de {{ rating.amount}} usuarios</p>
							<p v-else class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Se necesitan mínimo 3 votos para promediar una calificación</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Noti Plan -->
		<div class="modal fade" id="modalNotiPlan" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container d-flex">
							<button type="button" data-dismiss="modal" class="close" aria-label="Close" style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="text-center">
							<h5 class="modal-title h3">Plan Actual</h5>
							<p class="h1 mt-2">
								{{ current_plan.name }} <span v-if="current_plan.is_best === 1" style="color: #194DBE;"><i class="fas fa-medal"></i></span>
							</p>
						</div>

						<div
							v-if="current_plan.is_best === 1"
							class="text-center my-3" style="font-family: 'Nunito', sans-serif;"
						>
							<p class="text-muted h5">
								Tienes el mejor plan
								<i class="fa fa-star rating-star"></i><!--
								--><i class="fa fa-star rating-star"></i><!--
								--><i class="fa fa-star rating-star"></i>

							</p>
							<p class="text-muted h6">Aparecerás como <i>Usuario Destacado</i> en la página de Inicio.</p>
						</div>

						<div
							v-if="current_plan.is_best === 0"
							class="text-center my-3" style="font-family: 'Nunito', sans-serif;"
						>
							<p class="text-muted h5">
								<a href="/planes">Mejora tu plan.</a>
							</p>
							<p class="text-muted h6">Con el plan Premium aparecerás como <i>Usuario Destacado</i> en la página de Inicio.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Noti Coins modalNotiCoins-->
		<div class="modal fade" id="modalNotiCoins" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container d-flex">
							<button type="button" data-dismiss="modal" class="close" aria-label="Close" style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="text-center">
							<h5 class="modal-title h3">Coins</h5>
							<p class="display-4">{{ value_rating }} / 5</p>
						</div>

						<div class="rating-stars-modal container text-center">
							<rating-stars
								:amount_rating="rating.amount"
								:avg_rating="rating.value"
								:show_number="false"
								@value_rating="value_rating = $event"
								@show_rating="show_rating  = $event"
							>
							</rating-stars>
						</div>
						<div class="text-center">
							<p v-if="show_rating == true" class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Basados en la calificación de {{ rating.amount}} usuarios</p>
							<p v-else class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Se necesitan mínimo 3 votos para promediar una calificación</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Noti Views modalNotiViews-->
		<div class="modal fade" id="modalNotiViews" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container d-flex">
							<button type="button" data-dismiss="modal" class="close" aria-label="Close" style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="text-center">
							<h5 class="modal-title h3">Vistas</h5>
							<p class="display-4">{{ value_rating }} / 5</p>
						</div>

						<div class="rating-stars-modal container text-center">
							<rating-stars
								:amount_rating="rating.amount"
								:avg_rating="rating.value"
								:show_number="false"
								@value_rating="value_rating = $event"
								@show_rating="show_rating  = $event"
							>
							</rating-stars>
						</div>
						<div class="text-center">
							<p v-if="show_rating == true" class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Basados en la calificación de {{ rating.amount}} usuarios</p>
							<p v-else class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Se necesitan mínimo 3 votos para promediar una calificación</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Noti Messages modalNotiMessages-->
		<div class="modal fade" id="modalNotiMessages" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container d-flex">
							<button type="button" data-dismiss="modal" class="close" aria-label="Close" style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="text-center">
							<h5 class="modal-title h3">Notificaciones</h5>
							<p class="display-4">{{ value_rating }} / 5</p>
						</div>

						<div class="rating-stars-modal container text-center">
							<rating-stars
								:amount_rating="rating.amount"
								:avg_rating="rating.value"
								:show_number="false"
								@value_rating="value_rating = $event"
								@show_rating="show_rating  = $event"
							>
							</rating-stars>
						</div>
						<div class="text-center">
							<p v-if="show_rating == true" class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Basados en la calificación de {{ rating.amount}} usuarios</p>
							<p v-else class="text-muted h5" style="font-family: 'Nunito', sans-serif;">Se necesitan mínimo 3 votos para promediar una calificación</p>
						</div>
					</div>
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
				categories_data: this.data.account_data.categories_data,
				//
				value_rating: 0,
				show_rating: false,
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
	.welcome-img {
		height: 200px;
	}

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

	@media (max-width: 768px) {
		figure.snip {
			height: 180px;
		}

		.box-profile-img h4 {
			font-size: 16px;
		}

		.box-profile-img ul {
			font-size: 12px;
		}

		.welcome-text {
			padding: 0px 25px;
		}

		.adv .row{
			margin: 0;
		}
	}

	@media (max-width: 768px) and (orientation: landscape){
		.btn-view-profile {
			width: 60%;
			float: none;
		}

		.box-profile-img {
			width: 60%;
			margin: 0 auto;
		}

		.box-profile-img h4 {
			font-size: 23px;
		}

		.box-profile-img ul {
			font-size: 16px;
		}

		figure.snip {
			margin: 0 auto 1rem;
		}
	}


	@media (max-width: 568px) {
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

		.panel-alert {
			font-size: 14px;
		}
	}

	@media (max-width: 414px) and (orientation: portrait) {
		.welcome-text__title {
			font-size: 2.5rem;
		}

		.welcome-text__message {
			font-size: 1.1rem;
		}
	}
</style>
