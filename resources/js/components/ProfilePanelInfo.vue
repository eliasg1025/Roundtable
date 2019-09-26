<template>
	<div id="info-panel" >
		<h3>Información Empresa</h3>
		<div class="alert alert-secondary mt-3" role="alert">
			Modifica los datos de tu empresa, además agrega contenido multimedia. <i>¡Ten en cuenta que tu información de contacto será revelada <b>sólo</b> a las empresas que quieran hacer negocios contigo!</i>
		</div>
		<div class="container">

			<div class="row my-5">
				<div class="col-md-5">
					<p class="h5 text-center text-uppercase">Logotipo <span class="info-icon"><i class="fa fa-info-circle"></i></span></p>
					<figure class="upload-info-img container-profile-img">
						<img :src="profile_img"/>
						<figcaption>
							<div class="upload-info-input">
								<label class="bottom-middle" for="upload-profile-img"><i class="fa fa-upload"></i></label>
								<input id="upload-profile-img" type="file" accept="image/*">
							</div>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-7">
					<p class="title-image-cover h5 text-center text-uppercase">Banner <span class="info-icon"><i class="fa fa-info-circle"></i></span></p>
					<figure class="upload-info-img container-cover-img">
						<img :src="cover_img"/>
						<figcaption>
							<div class="upload-info-input">
								<label class="bottom-middle" for="upload-profile-img"><i class="fa fa-upload"></i></label>
								<input id="upload-profile-img" type="file" accept="image/*">
							</div>
						</figcaption>
					</figure>
				</div>
			</div>

			<!-- Btn copiar link -->
			<div class="text-center">
				<label for="" class="text-uppercase h5">Link de Perfil</label>
			</div>
			<div class="input-group" style="margin-bottom: 30px;">
				<input id="profileLink" type="text" class="form-control" readonly="readonly" :value="profile_link">
				<div class="input-group-append">
					<button class="btn btn-save" type="button" @click="copyLink()">
						Copiar
					</button>
				</div>
			</div>
		</div>
		<!-- Datos -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Datos Empresa</label>
		</div>
		<div class="panel-info-section container">
			<div class="form-group">
				<label for="">Razón Social <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<input type="text" class="form-control" placeholder="Razón Social" v-model="name">
			</div>
			<div class="form-group">
				<label for="">Nombre comercial <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<input type="text" class="form-control" placeholder="Nombre Comercial" v-model="commercial_name">
			</div>
			<div class="form-group">
				<label for="">Descripción <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<textarea class="form-control" id="" rows="5" v-model="description"></textarea>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Email <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="email" class="form-control" placeholder="Email" v-model="email">
				</div>
				<div class="form-group col-md-6">
					<label for="">Teléfono <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="text" class="form-control" placeholder="Teléfono" v-model="phone">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">RUC <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="ruc" class="form-control" placeholder="RUC" v-model="ruc" disabled="true">
				</div>
				<div class="form-group col-md-6">
					<label for="">Partida Registral <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="text" class="form-control" placeholder="Partida registral" v-model="legal_registration" disabled="true">
				</div>
			</div>
			<button class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">Guardar Cambios</button>
		</div>

		<!-- Imagenes -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Imagenes</label>
		</div>
		<div class="panel-info-section">
			<div class="container">
				<div class="alert alert-success" role="alert">
					<p>Dependiendo del tipo de plan que tengas puedes subir cierta cantidad de Imagenes:</p>
					<ul style="margin-left: 15px;">
						<li v-for="plan in plans" :key="plan.id" v-bind:class="{'active-plan': current_plan.id === plan.id}">
							{{ plan.name }}: {{plan.images}} imagenes <span v-if="current_plan.id === plan.id"><i class="fa fa-arrow-left" aria-hidden="true"></i> Tu plan</span>
						</li>
					</ul>
				</div>
			</div>

			<div id="multi-carousel-images">
				<div class="multi-carousel-item" v-for="image in images" :key="image.id">
					<div class="multi-image-container">
						<img :src="image.url" class="multi-image">
					</div>
				</div>
				<div class="multi-carousel-item">
					<div class="multi-add-container">
						<div class="multi-image">
							<label class="multi-add-text" for="upload-multi-image">
								<p><i class="fa fa-plus" aria-hidden="true"></i></p>
								<p>Agregar Imagen</p>
							</label>
							<input type="file" accept="image/*" id="upload-multi-image" style="display: none;">
						</div>
					</div>
				</div>
			</div>
			<div class="multi-preview jumbotron">
				Puedes agregar: {{ might_add_image }} imagen(s)
			</div>
		</div>

		<!-- Videos -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Videos</label>
		</div>
		<div class="panel-info-section">
			<div class="container">
				<div class="alert alert-success" role="alert">
					<p>Dependiendo del tipo de plan que tengas puedes subir cierta cantidad de videos:</p>
					<ul style="margin-left: 15px;">
						<li v-for="plan in plans" :key="plan.id" v-bind:class="{'active-plan': current_plan.id === plan.id}">
							{{ plan.name }}: {{plan.videos}} videos <span v-if="current_plan.id === plan.id"><i class="fa fa-arrow-left" aria-hidden="true"></i> Tu plan</span>
						</li>
					</ul>
				</div>
			</div>
			<div id="multi-carousel-videos">
				<div class="multi-carousel-item" v-for="video in videos" :key="video.id">
					<div class="multi-image-container">
						<video :src="video.url" class="multi-image"></video>
					</div>
				</div>
				<div class="multi-carousel-item">
					<div class="multi-add-container">
						<div class="multi-image">
							<label class="multi-add-text" for="upload-multi-video">
								<p><i class="fa fa-plus" aria-hidden="true"></i></p>
								<p>Agregar Video</p>
							</label>
							<input type="file" accept="video/*" id="upload-multi-video" style="display: none;">
						</div>
					</div>
				</div>
			</div>
			<div class="multi-preview jumbotron">
				Puedes agregar: {{ might_add_videos }} video(s)
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'user',
			'media_data',
			'current_plan'
		],
		data() {
			return {
				name: '',
				commercial_name: '',
				phone: '',
				ruc: '',
				legal_registration: '',
				email: '',
				description: '',
				profile_img: '',
				cover_img: '',
				images: [],
				videos: [],
				// Debe ser obtenido de una API
				plans: [
					{
						id: 1,
						name: 'Free',
						images: 3,
						videos: 0
					},
					{
						id: 2,
						name: 'Standard Business',
						images: 6,
						videos: 1
					},
					{
						id: 3,
						name: 'Premium Business',
						images: 10,
						videos: 3
					}
				]
			}
		},
		created() {
			this.name = this.user.name
			this.commercial_name = this.user.commercial_name
			this.phone = this.user.phone
			this.ruc = this.user.ruc
			this.legal_registration = this.user.legal_registration
			this.email = this.user.email
			this.description = this.user.description
			this.profile_img = this.user.profile_img
			this.cover_img = this.user.cover_img
			this.images = this.media_data.images
			this.videos = this.media_data.videos
		},
		mounted() {
			const multi_carousel_images = Tiny.tns({
				container: '#multi-carousel-images',
				items: 1,
				slideBy: 1,
				responsive: {
					768: {
						items: 2
					},
					1100: {
						items: 3
					}
				}
			})

			const multi_carousel_videos = Tiny.tns({
				container: '#multi-carousel-videos',
				items: 1,
				slideBy: 1,
				responsive: {
					768: {
						items: 2
					},
					1100: {
						items: 3
					}
				}
			})
		},
		computed: {
			profile_link() {
				return window.location.origin + '/business/profile/' + this.user.slug
			},
			might_add_image() {
				return this.plans[0].images - this.images.length
			},
			might_add_videos() {
				return this.plans[0].videos - this.videos.length
			}
		},
		methods: {
			copyLink() {
				const copiedLink = document.querySelector('#profileLink');
				copiedLink.select();
				copiedLink.setSelectionRange(0, 99999);
				document.execCommand('copy');

				Swal.fire({
					position: 'top-end',
					type: 'success',
					title: 'Link copiado',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	}
</script>

<style>
	.active-plan {
		font-weight: bold;
	}

	.multi-carousel-item {
		padding: 10px;
	}

	.upload-info-img {
		position: relative;
		overflow: hidden;
		margin: 10px 0;
		text-align: center;
		border-radius: 8px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
	}

	.upload-info-img * {
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-transition: all 0.6s ease;
		transition: all 0.6s ease;
	}

	.upload-info-img img {
		opacity: 1;
		display: block;
		height: 250px;
		position: relative;
	}

	.upload-info-img figcaption {
		top: 25%;
		left: 0;
		right: 0;
		bottom: 0;
		margin: 10px 12px 5px;
		position: absolute;
	}

	.upload-info-img h4, .upload-info-img i {
		color: rgba(0, 0, 0, 0.7);
	}

	.upload-info-img i {
		font-size: 100px;
	}

	.upload-info-img a {
		text-decoration: none;
	}

	.upload-info-img .bottom-middle, .upload-info-img .bottom-right {
		bottom: 40%;
		opacity: 0;
	}
	.upload-info-img .bottom-middle {
		-webkit-transform: translate(0%, 50%);
		transform: translate(0%, 50%);
	}

	.upload-info-img:hover img, .upload-info-img.hover img {
		opacity: 0.6;
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}
	.upload-info-img:hover figcaption .bottom-middle, .upload-info-img.hover figcaption .bottom-middle,
	.upload-info-img:hover figcaption .bottom-right, .upload-info-img.hover figcaption .bottom-right {
		-webkit-transform: translate(0, 0);
		transform: translate(0, 0);
		opacity: 1;
	}

	.upload-info-input > input {
		display: none;
	}

	.upload-info-input > label {
		cursor: pointer;
	}

	.container-profile-img img {
		width: 85%;
		margin: auto;
	}

	.container-cover-img img {
		width: 100%;
	}

	/* Form styles */

	.btn-save {
		background-image: linear-gradient(to right, #56ab2f 0%, #a8e063 51%, #56ab2f 100%);
		transition: 0.5s;
		background-size: 200% auto;
		font-family: 'Roboto',sans-serif;
		color:rgb(231, 255, 255);
	}

	.btn-save:hover {
		background-position: right center;
		color:rgb(231, 255, 255);
	}

	.info-icon {
		color: rgb(93, 151, 240);
		cursor: pointer;
	}

	.info-icon:hover {
		color: rgb(81, 126, 194);
		transition: all ease 500ms;
	}

	.panel-info-section {
		border: solid 1px #e6e6e6;
		border-radius: 15px;
		padding: 25px;
		margin-bottom: 35px;
	}

	.panel-info-subtitle {
		margin-bottom: 15px;
	}

	.panel-info-subtitle label {
		margin: 0;
	}

	.multi-image-container {
		position: relative;
		overflow: hidden;
		margin: 10px 0;
		text-align: center;
		border-radius: 8px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
		background-color: #000;
		cursor: pointer;
		height: 150px;
	}

	.multi-add-container {
		position: relative;
		overflow: hidden;
		margin: 10px 0;
		text-align: center;
		border-radius: 8px;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
		height: 150px;
	}

	.multi-image {
		opacity: 1;
		display: block;
		height: 100%;
		position: relative;
		width: 100%;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-transition: all 0.6s ease;
		transition: all 0.6s ease;
	}

	.multi-add-text {
		margin-top: 20%;
		cursor: pointer;
	}

	.multi-add-text p {
		margin-bottom: 0px;
		font-size: 20px;
		color: #D87B4B;
	}

	.multi-image:hover{
		opacity: 0.6;
		-webkit-transform: scale(1.1);
		transform: scale(1.1);
	}

	@media screen and (max-width: 768px) {
		.container-profile-img img {
			height: 170px;
		}

		.container-cover-img img {
			height: 170px;
		}

		.multi-image-container {
			height: 100px;
		}
	}

	@media screen and (max-width: 600px) {
		.container-profile-img {
			width: 80%;
			margin: auto;
		}
		.container-profile-img img {
			height: 150px;
		}
		.container-cover-img img {
			height: 150px;
		}
		.title-image-cover {
			margin-top: 25px;
		}
		.multi-image-container {
			height: 150px;
		}
	}
</style>
