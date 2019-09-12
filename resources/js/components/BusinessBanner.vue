<template>
	<section>
		<section :id="this.id" class="businessBanner">
			<div class="container">
				<div class="row row_heigth">
					<div class="col-md-12 text-center">
						<div class="profile-img">
							<img :src="this.data_user.profile_img" alt="" class="img-fluid">
						</div>
					</div>

					<div class="col-md-12 business-text">
						<div class="text-center">
							<div class="business-name">
								<h2>{{ this.data_user.commercial_name }}</h2>
							</div>
							<!--
							<p v-if="this.data_user.address !== null" class="business-address text-muted">
								{{ this.data_user.address }}
							</p> -->
							<p class="business-description">{{ this.data_user.description }}</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- <div class="wave">
			<div style="height: 150px; overflow: hidden;" >
				<svg
					viewBox="0 0 500 150"
					preserveAspectRatio="none"
					style="height: 100%; width: 100%;"
				>
					<path
						d="M0.00,49.98 C238.42,46.88 237.30,47.86 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
						style="stroke: none; fill: #f1f1f1;"
					>
					</path>
				</svg>
			</div>
		</div> -->
		<div class="business-stats">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<ul class="nav justify-content-center">
							<li class="nav-item">
								<a href="" class="nav-link nav__business-stat" data-toggle="modal" data-target="#modalStats-rating">
									<div class="stat-value"><i class="fa fa-star"></i> {{ this.rating }} </div>
									<div class="stat-name">Valoración</div>
								</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link nav__business-stat" data-toggle="modal" data-target="#modalStats-certifications">
									<div class="stat-value"><i class="fa fa-certificate"></i> {{ this.amount_certifications }} </div>
									<div class="stat-name">Certificados</div>
								</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link nav__business-stat" data-toggle="modal" data-target="#modalStats-products">
									<div class="stat-value"><i class="fa fa-lemon-o"></i> {{ this.amount_offers }} </div>
									<div class="stat-name">Ofertas</div>
								</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link nav__business-stat" data-toggle="modal" data-target="#modalStats-categories">
									<div class="stat-value"><i class="fa fa-tags"></i> {{ this.amount_categories }} </div>
									<div class="stat-name">Categorías</div>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-4" style="margin: auto;">
						<button class="btn btn-block btn-agendar">
							Agendar
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modals -->
		<div class="stats-modals">
			<!-- Modal Rating -->
			<div class="modal fade" id="modalStats-rating" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalStats-rating">Valoraciones</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-5">
									<img src="/img/fondo/fondo_login.jpg" class="card-img-top">
								</div>
								<div class="col-md-7">
									<ul>
										<li>Certificado 1</li>
										<li>Certificado 2</li>
										<li>Certificado 3</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Certifications -->
			<div class="modal fade" id="modalStats-certifications" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalStats-certifications">Certificaciones</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="container">
								<ul>
									<li>ISO 9001</li>
									<li>ISO 9001</li>
									<li>ISO 9001</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Categories -->
			<div class="modal fade" id="modalStats-categories" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalStats-categories">Producto 1</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-5">
									<img src="/img/fondo/fondo_login.jpg" class="card-img-top">
								</div>
								<div class="col-md-7">
									<ul>
										<li>Certificado 1</li>
										<li>Certificado 2</li>
										<li>Certificado 3</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: [
			'data_user',
			'data_account'
		],
		data() {
			return {
				id: this.data_user.name.replace(/ |:|,/gi, '-'),
				rating: this.rounded_rating(),
				amount_certifications: this.data_account.user_certifications.length,
				amount_offers: this.data_account.offers_data.length,
				amount_categories: this.data_account.categories_data.length,
			}
		},
		mounted() {
			let el = document.querySelector(`#${this.id}`);
			el.style = `background-image: url('${this.data_user.cover_img}')`;
		},
		methods: {
			rounded_rating() {
				return Math.round(this.data_account.rating_data.value * 2) / 2;
			}
		}
	}
</script>

<style>
	.businessBanner {
		padding: 200px 0 100px 0;
		background-size: cover;
		background-position: center;
		position: relative;
		background-color: #FDFDFD;
		box-shadow: 0px 0px 4px 0px rgba(0,0,0,0.75);
	}
	.businessBanner:before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #000;
		opacity: .3;
	}
	.wave {
		margin-top: -100px;
		z-index: 100;
		position: relative;
	}
	.profile-img {
		background-color: #fff;
		display: inline-block;
		max-width: 270px;
		border-radius: 50%;
		box-shadow: 0px 0px 1px 1px #B7B7B76B;
		margin-top: 150px;
		position: relative;
		z-index: 1000;
	}
	.profile-img img {
		max-width: 100%;
		padding: 30px;
	}

	@media (max-width: 600px) {
		.profile-img {
			margin-top: 170px;
			max-width: 200px;
		}
	}

	.business-text {
		z-index: 1000;
		margin-bottom: 100px;
	}

	.business-name {
		margin-top: 20px;
	}

	.business-name h2 {
		font-family: 'Roboto', sans-serif;
		text-transform: uppercase;
		font-weight: 700;
		display: inline-block;
		position: relative;
		margin-top: 10px;
		border-left: 5px solid #88be2e;
		border-right: 5px solid #88be2e;
		padding-left: 8px;
		padding-right: 8px;
	}

	.business-name h2:before {
		content: "";
	    height: 5px;
	    width: 40px;
		background-color: #88be2e;
		position: absolute;
		left: 0;
		top: 0;
		margin-top: -5px;
		margin-left: -5px;
	}

	.business-name h2:after {
		content: "";
	    height: 5px;
	    width: 40px;
		background-color: #88be2e;
		position: absolute;
		bottom: 0;
		right: 0;
		margin-bottom: -5px;
		margin-right: -5px;
	}

	.business-address {
		margin-top: 10px;
		font-weight: 600;
	}

	.business-description {
		margin-top: 15px;
	}

	@media (max-width: 600px) {
		.business-name h2 {
			font-size: 25px;
		}

		.business-address {
			font-size: 14px;
		}

		.business-description {
			font-size: 15px;
		}
	}

	/* Stat names */

	.business-stats {
		padding-top: 350px;
		padding-bottom: 20px;
	}

	.business-stats .btn-agendar {
		background-color: #88be2e;
		color: #fff;
		font-family: 'Roboto', sans-serif;
		text-transform: uppercase;
		transition: ease 0.3s;
		box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
		letter-spacing: 2px;
		font-weight: 700;
	}

	.business-stats .btn-agendar:hover {
		margin-top: -5px;
		margin-left: -5px;
		transition: ease 0.3s;
		box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.75);
	}

	.nav__business-stat {
		color: #212529;
		font-family: 'Roboto', sans-serif;
	}

	.business-stats .nav-item {
		width: 25%;
		text-align: center;
	}

	.nav__business-stat:hover {
		color: #88be2e;
		margin-top: -1px;
		margin-left: -1px;
	}

	.stat-value {
		font-size: 30px;
	}

	.stat-name {
		font-size: 20px;
	}

	@media (max-width: 600px) {
		.stat-value {
			font-size: 20px;
		}

		.stat-name {
			font-size: 15px;
		}
	}

	@media (max-width: 360px) {
		.business-description {
			font-size: 14px;
		}

		.stat-value {
			font-size: 17px;
		}

		.stat-name {
			font-size: 12px;
		}
	}

	/* Modals */

	.stats-modals {
		font-family: 'Roboto', sans-serif;
	}
</style>
