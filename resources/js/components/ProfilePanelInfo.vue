<template>
	<div id="info-panel" >
		<h3>Información Empresa</h3>
		<div class="alert alert-secondary mt-3" role="alert">
			En esta sección puedes visualizar los datos públicos de tu empresa asi como modificarlos.
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

			<!--
			<div class="input-group input-group-lg" style="margin-bottom: 30px;">
				<div class="input-group-prepend">
					<span class="input-group-text">Link de perfil</span>
				</div>
				<input type="text" class="form-control" disabled="true" v-model="">
			</div>
			-->

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
					<label for="">Telefono <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="text" class="form-control" placeholder="Telefono" v-model="phone">
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

			<button class="btn btn-lg btn-block btn-save">Guardar Cambios</button>
		</div>

	</div>
</template>

<script>
	export default {
		props: ['user'],
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
			}
		},
		mounted() {
			this.name = this.user.name
			this.commercial_name = this.user.commercial_name
			this.phone = this.user.phone
			this.ruc = this.user.ruc
			this.legal_registration = this.user.legal_registration
			this.email = this.user.email
			this.description = this.user.description
			this.profile_img = this.user.profile_img
			this.cover_img = this.user.cover_img
		}
	}
</script>

<style>
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
		margin-top: 25px;
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
			margin-top: 30px;
		}
	}
</style>
