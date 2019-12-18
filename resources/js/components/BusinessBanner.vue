<template>
	<section>
		<section :id="this.id" class="businessBanner">
			<div class="container">
				<div class="row row_heigth">
					<div class="col-md-12 text-center">
						<div class="profile-img">
							<img
								:src="this.data_user.profile_img"
								class="img-fluid"
							/>
						</div>
					</div>

					<div class="col-md-12 business-text">
						<div class="text-center">
							<div class="business-name">
								<h2>{{ this.data_user.commercial_name }}</h2>
								<span
									v-if="this.data_user.verified == 2"
									class="is-verified"
									style="font-size: 25px;"
									><i
										data-tippy-content="Empresa verificada"
										class="fas fa-check-circle"
									></i
								></span>
							</div>
							<p class="business-address text-muted h4">
								<span v-if="loading_type"
									><i class="fas fa-spinner fa-spin"></i
								></span>
								<span v-else
									><i class="fas fa-tag"></i>
									{{ type_user }}</span
								>
							</p>
							<p class="business-description">
								{{ this.data_user.description }}
							</p>
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
								<a
									href=""
									class="nav-link nav__business-stat"
									data-toggle="modal"
									data-target="#modalStats-rating"
								>
									<div class="stat-value">
										<i class="fa fa-star"></i>
										{{ value_rating }}
									</div>
									<div class="stat-name">Valoración</div>
								</a>
							</li>
							<li class="nav-item">
								<a
									href=""
									class="nav-link nav__business-stat"
									data-toggle="modal"
									data-target="#modalStats-certifications"
								>
									<div class="stat-value">
										<i class="fas fa-award"></i>
										{{ this.certifications.length }}
									</div>
									<div class="stat-name">Certificados</div>
								</a>
							</li>
							<li class="nav-item">
								<a
									href="#businessProductSection"
									class="nav-link nav__business-stat"
								>
									<div class="stat-value">
										<i class="fas fa-apple-alt"></i>
										{{ this.amount_offers }}
									</div>
									<div class="stat-name">Ofertas</div>
								</a>
							</li>
							<li class="nav-item">
								<a
									href=""
									class="nav-link nav__business-stat"
									data-toggle="modal"
									data-target="#modalStats-categories"
								>
									<div class="stat-value">
										<i class="fa fa-tags"></i>
										{{ this.categories.length }}
									</div>
									<div class="stat-name">Categorías</div>
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-4" style="margin: auto;">
						<div v-if="data_visit_user.data === false">
							<a
								class="btn btn-block btn-agendar have-to-login"
								data-toggle="modal"
								data-target="#login"
							>
								<span style="color: white;">Agendar</span>
							</a>
						</div>

						<div v-else>
							<div
								v-if="data_visit_user.data.id !== data_user.id"
								class="text-center"
							>
								<div v-if="loading_btn">
									<button
										type="button"
										class="btn btn-block btn-agendar-off disabled"
										disabled
									>
										Espere
										<i class="fas fa-spinner fa-spin"></i>
									</button>
								</div>
								<div v-else>
									<div v-if="can_send_meet === true">
										<button
											type="button"
											class="btn btn-block btn-agendar"
											data-toggle="modal"
											data-target="#modalAgendar"
										>
											Agendar
										</button>
										<small class="mt-1">
											<span class="text-muted"
												>Esta operación cuesta 30 coins.
												<a
													href="/planes"
													target="_blank"
													>Conseguir coins.</a
												></span
											>
										</small>
									</div>
									<div v-else>
										<button
											type="button"
											class="btn btn-block btn-agendar-off disabled"
											disabled
										>
											Agendado
										</button>
										<small class="mt-1">
											<span class="text-muted"
												>Debes esperar la confirmación
												de esta empresa.</span
											>
										</small>
									</div>
								</div>
							</div>

							<a
								v-if="data_visit_user.data.id === data_user.id"
								class="btn btn-block btn-agendar"
								href="/profile"
							>
								Editar Perfil
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modals -->
		<div class="stats-modals">
			<!-- Modal Rating -->
			<div
				class="modal fade"
				id="modalStats-rating"
				tabindex="-1"
				role="dialog"
				aria-hidden="true"
			>
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="container d-flex">
								<button
									type="button"
									data-dismiss="modal"
									class="close"
									aria-label="Close"
									style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;"
								>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="text-center">
								<h5 class="modal-title h3">Valoración</h5>
								<p class="display-4">{{ value_rating }} / 5</p>
							</div>

							<div
								class="rating-stars-modal container text-center"
							>
								<rating-stars
									:amount_rating="rating.amount"
									:avg_rating="rating.value"
									:show_number="false"
									@value_rating="value_rating = $event"
									@show_rating="show_rating = $event"
								>
								</rating-stars>
							</div>
							<div class="text-center">
								<p
									v-if="show_rating == true"
									class="text-muted h5"
									style="font-family: 'Nunito', sans-serif;"
								>
									Basados en la calificación de
									{{ data_account.rating_data.amount }}
									usuarios
								</p>
								<p
									v-else
									class="text-muted h5"
									style="font-family: 'Nunito', sans-serif;"
								>
									Se necesitan mínimo 3 votos para promediar
									una calificación
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Certifications -->
			<div
				class="modal fade"
				id="modalStats-certifications"
				tabindex="-1"
				role="dialog"
				aria-hidden="true"
			>
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="container d-flex">
								<button
									type="button"
									data-dismiss="modal"
									class="close"
									aria-label="Close"
									style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;"
								>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="text-center">
								<h5 class="modal-title h3">Certificaciones</h5>
							</div>
							<div class="business-stat-modal container">
								<div v-if="certifications.length > 0">
									<ul class="nav justify-content-center">
										<!-- For certification -->
										<li
											v-for="(certification,
											index) in certifications"
											:key="index"
											class="nav-item"
										>
											<a
												:href="certification.url"
												target="_blank"
												class="business-stat-modal__item"
											>
												<i
													class="fas fa-file-pdf"
													aria-hidden="true"
													style="color: #D54841; font-size: 50px;"
												></i>
												<p style="margin-top: 15px;">
													{{ certification.title }}
												</p>
											</a>
										</li>
									</ul>
								</div>
								<div v-else>
									<div
										style="color: rgb(147, 147, 147); margin: 10px 0px 10px;"
										class="text-center"
									>
										No hay certificaciones disponibles
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Categories -->
			<div
				class="modal fade"
				id="modalStats-categories"
				tabindex="-1"
				role="dialog"
				aria-hidden="true"
			>
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<div class="container d-flex">
								<button
									type="button"
									data-dismiss="modal"
									class="close"
									aria-label="Close"
									style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;"
								>
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="text-center">
								<h5 class="modal-title h3">Categorías</h5>
							</div>
							<div class="business-stat-modal container">
								<div v-if="categories.length > 0">
									<ul class="nav justify-content-center">
										<!-- For category -->
										<li
											v-for="(category,
											index) in categories"
											:key="index"
											class="nav-item"
										>
											<a
												href=""
												target="_blank"
												class="business-stat-modal__item"
											>
												<img
													:src="category.picture"
													class="img-fluid"
													style="height: 70px;"
												/>
												<p style="margin-top: 10px;">
													{{ category.name }}
												</p>
											</a>
										</li>
									</ul>
								</div>
								<div v-else>
									<div
										style="color: rgb(147, 147, 147); margin: 10px 0px 10px;"
										class="text-center"
									>
										Esta empresa aun no tiene categorías
										seleccionadas
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Agendar -->
			<modal-agendar
				:data_user="data_user"
				:data_visit_user="data_visit_user"
			></modal-agendar>
		</div>
	</section>
</template>

<script>
import tippy from "tippy.js";
import "../../../node_modules/tippy.js/index.css";
import ModalAgendar from "./ModalAgendar.vue";

export default {
	components: {
		ModalAgendar
	},
	props: ["data_user", "data_account", "data_visit_user"],
	data() {
		return {
			id: this.data_user.name.replace(/ |:|,|'|.|°/gi, "-"),
			amount_offers: this.data_account.offers_data.length,
			categories: this.data_account.categories_data,
			certifications: this.data_account.user_certifications,
			rating: this.data_account.rating_data,
			value_rating: 0,
			show_rating: false,
			type_user: "",
			can_send_meet: true,
			loading_btn: true,
			loading_type: true
		};
	},
	created() {
		axios.get("/profile/types").then(res => {
			res.data.data.forEach(element => {
				if (element.id === this.data_user.type_id) {
					this.loading_type = false;
					this.type_user = element.name;
				}
			});
		});

		axios
			.post("/business/check-meet", {
				receiver_id: this.data_user.id
			})
			.then(res => {
				console.log(res.data.data);
				this.can_send_meet =
					res.data.data.state_id === 2 ||
					res.data.data.state_id === 4;
				this.loading_btn = false;
			})
			.catch(err => {
				console.log(err.response.data);
				this.loading_btn = false;
			});
	},
	mounted() {
		tippy("[data-tippy-content]");
		// Give img to banner
		let el = document.querySelector(`#${this.id}`);
		el.style = `background-image: url('${this.data_user.cover_img}')`;
	}
};
</script>

<style lang="scss">
.businessBanner {
	padding: 200px 0 100px 0;
	background-size: cover;
	background-position: center;
	position: relative;
	background-color: #fdfdfd;
	box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.75);
}
.businessBanner:before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: 0.3;
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
	box-shadow: 0px 0px 1px 1px #b7b7b76b;
	margin-top: 150px;
	position: relative;
	z-index: 1000;
}
.profile-img img {
	max-width: 100%;
}

.business-text {
	z-index: 1000;
	margin-bottom: 100px;
}

.business-name {
	margin-top: 20px;
}

.business-name h2 {
	font-family: "Roboto", sans-serif;
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

/* Stat names */

.business-stats {
	padding-top: 400px;
	padding-bottom: 20px;
}

.business-stats .btn-agendar,
.business-stats .btn-agendar-off {
	background-color: #88be2e;
	color: #fff;
	font-family: "Roboto", sans-serif;
	text-transform: uppercase;
	transition: ease 0.3s;
	box-shadow: 0px 0px 2px 0px rgba(0, 0, 0, 0.75);
	letter-spacing: 2px;
	font-weight: 700;
}

.business-stats .btn-agendar:hover {
	margin-top: -2px;
	margin-left: -2px;
	transition: ease 0.3s;
	box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.75);
}

.nav__business-stat {
	color: #212529;
	font-family: "Roboto", sans-serif;
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

/* Modals */

.stats-modals {
	font-family: "Roboto", sans-serif;
}

.rating-stars-modal {
	font-size: 40px;
}

.rating-stars-modal li {
	margin-right: 10px;
}

.business-stat-modal .nav {
	margin-top: 25px;
}

.business-stat-modal .nav-item {
	width: 33%;
	text-align: center;
	padding: 10px;
}

.business-stat-modal__item {
	display: block;
	padding: 5px;
	background: #f1f1f1;
	border-radius: 5px;
	box-shadow: 0px 0px 1px 1px #cecece;
	text-decoration: none;
	color: #212529;
}

#modalAgendar {
	font-family: "Nunito", sans-serif;
}

.business-meet-card {
	color: #383d41;
	background-color: #e2e3e5;
	border: 2px solid #d6d8db;
	border-radius: 6px;
	max-width: 309px;
	margin: auto;
}

.business-meet-name p {
	text-transform: uppercase;
	font-weight: 600;
}

.form-destinity {
	margin-bottom: 5px;
}

@media (max-width: 700px) {
	.modal-body__agendar {
		padding: 0 1.5rem;
	}
}

@media (max-width: 600px) {
	.profile-img {
		margin-top: 170px;
		max-width: 200px;
	}

	.business-name h2 {
		font-size: 25px;
	}

	.business-address {
		font-size: 14px;
	}

	.business-description {
		font-size: 15px;
	}

	.stat-value {
		font-size: 20px;
	}

	.stat-name {
		font-size: 15px;
	}

	.form-destinity.second {
		margin-top: 15px;
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
</style>
