<template>
	<div class="container" style="padding: 60px 10px;">
		<div class="row justify-content-center">
			<div class="card">
				<div class="card-body">

					<form method="POST">
						<!-- Envio del token -->
						<input type="hidden" name="_token" :value="this.csrf">
						<div class="row text-center mb-3">
							<div class="col-md-12" style="color: #7e7e7e;">
								Ingresa tu correo y en breve estaremos enviando un mail para que restaures tu contraseña.	
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<input
									id="email"
									type="email"
									class="form-control"
									name="email"
									v-model="email"
									placeholder="Correo electrónico"
									required autocomplete="email"
									autofocus
								>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-12 text-center">
								<button
									@click="send_email()"
									type="button"
									class="btn"
									style="color: #fff; background-color: #88be2e; border-color: #88be2e;"
								>
									Enviar Correo
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'csrf',
			'href_password_email',
			'message',
		],
		data() {
			return {
				email: '',
			}
		},
		methods: {
			send_email() {
				axios.post(this.href_password_email, {
					email: this.email,
					token: this.csrf
				})
					.then(res => {
						Swal.fire({
							title: 'Email enviado!',
							text: 'Si el email no fue enviado verifique que la dirección email es correcta',
							type: 'success'
						})
					})
					.catch(error => {
						Swal.fire({
							title: 'Error',
							text: 'Escriba una dirección de correo electrónico válida',
							type: 'error'
						})
					});
			}
		}
	}
</script>

<style>
	
</style>