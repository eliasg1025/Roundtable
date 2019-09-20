<template>
	<div id="login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document" style="margin-top: 41.5px;">
			<div class="modal-content">
				<button type="button" aria-label="Close" data-dismiss="modal" class="close boton-cierre">
					<span aria-hidden="true">×</span>
				</button>

				<!-- Imagenes de Modal -->
				<div id="back">
					<div class="backRight"></div>
					<div class="backLeft"></div>
				</div>

				<div id="slideBox" style="margin-left: 0px;">
					<div class="topLayer" style="margin-left: 100%;">
						<div class="left">

							<!-- Spinner -->
							<div class="load-layer" v-show="login_loading">
								<spinner></spinner>
							</div>

							<!-- Login Form -->
							<form id="formLogin" method="POST" :action="this.href_login">

								<!-- Envio del token -->
								<input type="hidden" name="_token" :value="this.csrf">

								<div class="content">
									<h4>
										<b>Inciar Sesión</b>
									</h4>
									<div class="group mt-3">
										<input
											type="text"
											id="login-id"
											v-model="login.email"
											placeholder=" "
										>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Email</label>
									</div>
									<div class="group m-0">
										<input
											type="password"
											id="pass-id"
											v-model="login.password"
											placeholder=" "
										>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Contraseña</label>
									</div>
									<div class="form-check">
										<input type="checkbox" id="pass-check" value="check-me" placeholder=" " npm="">
										<label for="pass-check" id="label">
											<small>&nbsp;Mostrar mi clave</small>
										</label>
									</div>
									<button @click="login_user()" type="button" class="btn-block btn-hover color-1">
										Iniciar Sesión
									</button>
									<button type="button" class="btn-block btn-gradient-zv d-none btnLoad">
										<img src="" alt="" class="loader-icon">
										&nbsp; Cargando
									</button>
									<a href="javascript:void(0)"></a>
									<p class="texto-login-op pointer">
										<a :href="this.href_reset_password" style="color: #000; font-weight: 600;">
											¿Haz olvidado tu contraseña?
										</a>
									</p>
									<a id="goLeft">
										<p class="texto-login-op pointer">¿Aún no tienes cuenta?
											<b class="wine"><b> Regístrate Aquí</b></b>
										</p>
									</a>
								</div>
							</form>
							<!-- End Login Form -->
						</div>
						<div class="right">

							<!-- Spinner -->
							<div class="load-layer" v-show="resgister_loading">
								<spinner></spinner>
							</div>

							<!-- Register Form -->
							<form id="formRegister" method="POST" :action="this.href_register">

								<!-- Envio del token -->
								<input type="hidden" name="_token" :value="this.csrf">

								<div class="content">
									<h4><b>Registrate</b></h4>
									<div class="group my-3">
										<input type="text" id="signin-name" placeholder=" " v-model="register.name">
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Razón Social</label>
									</div>

									<div class="row p-0">
										<div class="col">
											<div class="group">
												<input type="text" id="signin-ruc" placeholder=" " v-model="register.ruc">
												<span class="highlight"></span>
												<span class="bar"></span>
												<label>RUC</label>
											</div>
										</div>
										<div class="col">
											<div class="group">
												<input type="text" id="signin-legal_registration" v-model="register.legal_registration" placeholder=" ">
												<span class="highlight"></span>
												<span class="bar"></span>
												<label>Partida Registral</label>
											</div>
										</div>
									</div>

									<div class="group" style="margin-top: -10px;">
										<input type="text" id="signin-id" placeholder=" " v-model="register.email">
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Email</label>
									</div>
									<div class="group">
										<select id="signin-type" placeholder=" " v-model="register.type_id">
											<option class="hidden" selected disabled>Seleccion una opción</option>
											<option value="1">Vendedor (Productor)</option>
											<option value="2">Vendedor (Acopiador)</option>
											<option value="3">Comprador</option>
										</select>
										<span class="highlight"></span>
										<span class="bar"></span>
									</div>
									<div class="group">
										<input
											type="password"
											id="pass-1-id"
											placeholder=" "
											v-model="register.password"
											data-toggle="tooltip"
											data-placement="bottom"
											title="Mínimo 8 caracteres"
										>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Contraseña</label>
									</div>
									<div class="group m-0">
										<input type="password" id="pass-2-id" placeholder=" " v-model="register.password_confirmation">
										<span class="highlight"></span>
										<span class="bar"></span>
										<label>Confirma tu contraseña</label>
									</div>
									<div class="form-check">
										<input type="checkbox" id="tc-check" value="check-me" name="checkTerminos" v-model="register.accept_terms">
										<label for="tc-check" id="label">
											<small>
												&nbsp;Acepto los
												<a href="#" target="_blank" class="wine">
													<b>&nbsp;Términos y Condiciones</b>
												</a>
											</small>
										</label>
									</div>
									<button @click="register_user()" type="button" class="btn-block btn-hover color-1">
										Registrarte
									</button>
									<button type="button" class="btn-block btn-gradient-zv d-none btnLoadRegister">
										<img src="" alt="" class="loader-icon">
										&nbsp; Cargando
									</button>
									<a id="goRight">
										<p class="texto-login-op pointer">
											¿Ya tienes cuenta? <b class="wine"><b>Inicia Sesión Aquí</b></b>
										</p>
									</a>
								</div>
							</form>
							<!-- End Register Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: [
		'csrf',
		'href_login',
		'href_register',
		'href_reset_password',
	],
	data() {
		return {
			login: {
				email: '',
				password: '',
				token: this.csrf,
			},
			register: {
				name: '',
				email: '',
				password: '',
				ruc: '',
				legal_registration: '',
				type_id: '',
				password: '',
				password_confirmation: '',
				token: this.csrf,
				accept_terms: false,
			},
			// Estados de las pantallas de carga
			login_loading: false,
			resgister_loading: false,
		}
	},
	methods: {
		login_user: function() {

			// Inciar pantalla de carga cuando se da click en Login
			this.login_loading = true;

			// Enviar los datos a la ruta /login a traves de axios.post
			axios.post(this.href_login, {
				// Envio de datos
				email: this.login.email,
				password: this.login.password,
				token: this.login.token,
			})
				.then(res => {
					// Si la operacion es exitosa mostrar mensaje de Sesion Iniciada
					Swal.fire({
						title: 'Iniciar Sesión',
						text: 'Sesión iniciada satifactoriamente',
						type: 'success',
						showConfirmButton: false,
						timer: 2000, // Mensaje dura 2s
						// Quitar pantalla de carga
						onBeforeOpen: () => {
							this.login_loading = false
						}
					}).then(result => {
						window.location.href = "/profile"; // Redirigir a ruta /profile
					})
				})
				.catch(error => {
					// Si hay error 422 mostrar error
					if (error.response.status === 422) {
						window.Swal.fire({
							title: 'El email o la contraseña son incorrectos',
							type: 'error',
							timer: 2000, // Mensaje dura 2s
							// Quitar pantalla de carga
							onBeforeOpen: () => {
								this.login_loading = false
							}
						})
					} else {
						console.log(error.response);
					}
				});
		},
		register_user: function() {

			// Inciar pantalla de carga cuando se da click en Register
			this.resgister_loading = true;

			// Enviar solo si acepta terminos y condiciones
			if (this.register.accept_terms) {

				// Enviar los datos a la ruta /register a traves de axios.post
				axios.post(this.href_register, {
					name: this.register.name,
					email: this.register.email,
					password: this.register.password,
					ruc: this.register.ruc,
					legal_registration: this.register.legal_registration,
					type_id: this.register.type_id,
					password: this.register.password,
					password_confirmation: this.register.password_confirmation,
					token: this.register.csrf,
				})
					.then(res => {
						Swal.fire({
							title: 'Usuario creado satisfactoriamente!',
							text: 'Por favor verifica tu correo electronico para validar tu cuenta',
							type: 'success',
							showConfirmButton: false,
							timer: 2000, // Mensaje dura 2s
							// Quitar pantalla de carga
							onBeforeOpen: () => {
								this.resgister_loading = false;
							}
						}).then(res => {
							window.location.href = "/profile"; // Redirigir a ruta /profile
						})
					})
					.catch(error => {
						if (error.response.status === 500) {
							console.log(error.response);
							window.Swal.fire({
								title: 'RUC ya usado',
								text: 'Por favor utiliza otro RUC o comunicate con nosotros nosotros.',
								type: 'error',
								timer: 2000, // Mensaje dura 2s
								// Quitar pantalla de carga
								onBeforeOpen: () => {
									this.resgister_loading = false
								}
							})
						} else if (error.response.status === 422) {
							if (error.response.data.errors.email !== undefined) {
								if (error.response.data.errors.email[0] == "The email has already been taken.") {
									window.Swal.fire({
										title: 'Email ya usado',
										text: 'Por favor utiliza otra dirección de email o comunicate con nosotros.',
										type: 'error',
										timer: 2000, // Mensaje dura 2s
										// Quitar pantalla de carga
										onBeforeOpen: () => {
											this.resgister_loading = false
										}
									})
								}
							} else {
								window.Swal.fire({
									title: 'Datos inválidos',
									text: 'Por favor verifica los datos enviados',
									type: 'error',
									timer: 2000, // Mensaje dura 2s
									// Quitar pantalla de carga
									onBeforeOpen: () => {
										this.resgister_loading = false
									}
								})
							}
						} else {
							console.log(error.response);
						}
					});
			} else {
				window.Swal.fire({
					title: 'Debe aceptar nuestros terminos y condiciones para poder continuar',
					type: 'info',
					showConfirmButton: false,
					timer: 2000, // Mensaje dura 2s
					// Quitar pantalla de carga
					onBeforeOpen: () => {
						this.resgister_loading = false
					}
				})
			}
		}
	}
}
</script>

<style>
	/* Forms */

	.modal-content {
		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-direction: column;
		flex-direction: column;
		width: 100%;
		pointer-events: auto;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid rgba(0,0,0,.2);
	}


	.modal-open .modal {
		overflow-x: hidden;
		overflow-y: auto;
	}

	.modal {
		position: fixed;
		z-index: 1050;
	}

	.modal, .modal-backdrop {
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
	}

	.fade {
		transition: opacity .15s linear;
	}

	#login .modal-content {
		width: auto;
		height: 550px;
		border-radius: 5px;
	}

	.backRight {
		background-image: url('/img/berry-blue-blueberries-70862 (1).jpg');
	}

	.backLeft {
		left: 0;
		background-image: url('/img/business-computer-computer-keyboard-2764678.jpg');
	}

	.backRight:before, .backLeft:before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #000;
		opacity: .4;
	}

	#slideBox {
		max-height: 100%;
		overflow: hidden;
		margin-left: 50%;
		box-shadow: 0 14px 28px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.22);
		z-index: 100000;
	}

	#slideBox, .backLeft, .backRight {
		width: 50%;
		height: 100%;
		position: absolute;
	}

	.topLayer {
		width: 200%;
		height: 100%;
		position: relative;
		left: 0;
		left: -100%;
	}

	.backLeft, .backRight {
		background-size: cover;
		background-position: 50% 50%;
	}

	.backRight, .right {
		right: 0;
		border-top-right-radius: 5px;
		border-bottom-right-radius: 5px;
	}

	.backLeft, .left {
		border-top-left-radius: 5px;
		border-bottom-left-radius: 5px;
	}

	.left {
		left: 0;
	}

	.left, .right {
		width: 50%;
		height: 100%;
		background: #fff;
	}

	.boton-cierre, .left, .right {
		position: absolute;
	}

	.left .content {
		top: 15%;
	}

	.left .content, .right .content {
		left: 17%;
		right: 17%;
		text-align: center;
		position: absolute;
	}

	.left .content {
		top: 15%;
	}

	.right .content {
		top: 12%;
	}

	.group {
		position: relative;
		margin-bottom: 25px;
	}

	.group input, .group select {
		font-size: 14px;
		padding: 5px;
		border: none;
		border-bottom: 1px solid #5d5d5d;
	}

	.bar, .group input , .group select {
		display: block;
		width: 100%;
	}

	.highlight {
		position: absolute;
		height: 60%;
		width: 100px;
		top: 25%;
		left: 0;
		pointer-events: none;
	}

	.highlight, .modal-backdrop.show {
		opacity: .5;
	}

	.bar {
		position: relative;
	}

	.bar, .group input, .group select {
		display: block;
		width: 100%;
	}

	.group input:placeholder-shown ~ label {
		color: #999;
		font-size: 14px;
		font-weight: 400;
		position: absolute;
		pointer-events: none;
		left: 5px;
		top: 5px;
		transition: .2s ease all;
		-moz-transition: .2s ease all;
		-webkit-transition: .2s ease all;
	}

	.group select {
		color: #000;
		background-color: #fff;
	}

	.group input:focus~label, .group label {
		top: -12px;
		color: #c73a71;
		font-size: 10px;
		font-weight: 400;
		position: absolute;
		pointer-events: none;
		left: 5px;
		transition: .2s ease all;
		-moz-transition: .2s ease all;
		-webkit-transition: .2s ease all;
	}

	.form-check {
		text-align: left;
		margin-top: 15px;
		padding-left: 0px;
	}

	#pass-check, #tc-check {
		border: 0;
		clip: rect(0 0 0 0);
		height: 1px;
		margin: -1px;
		overflow: hidden;
		padding: 0;
		position: absolute;
		width: 1px;
	}

	#pass-check+label, #tc-check+label {
		display: block;
	}

	#pass-check+label:before, #tc-check+label:before {
		content: '';
		display: inline-block;
		width: 15px;
		height: 15px;
		vertical-align: -3px;
		border: 2px solid #5d5d5d;
		margin-right: 4px;
		transition: border-color .2s ease,width .2s ease,-webkit-transform .2s ease;
		transition: transform .2s ease,border-color .2s ease,width .2s ease;
		transition: transform .2s ease,border-color .2s ease,width .2s ease,-webkit-transform .2s ease;
		-webkit-backface-visibility: hidden;
		backface-visibility: hidden;
	}

	#pass-check:checked+label:before, #tc-check:checked+label:before {
		border-color: #88be2e;
		border-top: 0;
		border-left: 0;
		width: 8px;
		margin-right: 8px;
		-webkit-transform: rotate(45deg);
		transform: translateY(-2px) rotate(45deg);
	}

	label {
		display: inline-block;
		margin-bottom: 0.5rem;
	}

	.loader-icon {
		width: 13px;
		height: 13px;
	}

	.texto-login-op {
		font-size: 12px;
		margin: 10px 0;
	}

	.pointer {
		cursor: pointer!important;
	}

	.wine {
		color: #000!important;
	}

	@media screen and (max-width: 600px) {
		#slideBox {
			width: 100%;
			margin-left: 0 !important;
		}
	}


	/* Buttons */

	.btn-hover {
		font-size: 15px;
		font-weight: 500;
		color: #fff;
		cursor: pointer;
		height: 30px;
		text-align: center;
		border: none;
		border-radius: 5px;

	}

	.btn-hover.color-1 {
		background-image: linear-gradient(to right,#851532,#C73A71,#F07F36,#FBA919);
	}

	.close:not(:disabled):not(.disabled), .navbar-toggler:not(:disabled):not(.disabled), summary {
		cursor: pointer;
	}

	button.close {
		padding: 0;
		border: 0;
		-webkit-appearance: none;
	}

	.boton-cierre {
		z-index: 10000000;
		right: 10px;
		top: 7px;
	}

	.close {
		float: right;
		font-size: 1.5rem;
		font-weight: 700;
		line-height: 1;
		color: #000;
		text-shadow: 0 1px 0 #fff;
		opacity: .5;
	}

	/* Spinner */
	.load-layer {
		position: absolute;
		height: 100%;
		width: 100%;
		z-index: 100000000;
		background-color: rgba(0,0,0,0.05);
		padding-top: 120px;
	}
</style>
