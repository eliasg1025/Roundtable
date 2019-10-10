<template>
	<div id="meet-panel" class="container">
		<h3>Agendamientos</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Gestiona tus agendamientos. Aquí podrás ver a las empresa que estan interesadas en tus productos y desean contactarse contigo.
			<br>
			<i><b>Solicitar un agendamiento</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a>. Y <b>aceptar un agendamiento</b> te cuesta <a href="/planes" target="_blank"><b>10 coins</b></a>.</i>
		</div>
		<div class="container">
			<div class="text-center panel-info-subtitle mt-4">
				<label for="" class="text-uppercase h5">Datos para el agendamiento</label>
			</div>
			<div class="container">
				<div class="form-group">
					<label for=""><img src="/img/iconos/hangout_logo.png" height="17"> Hangouts</label>
					<input type="text" class="form-control" placeholder="Perfil de Hangouts" v-model="hangouts_url">
				</div>
				<div class="form-group">
					<label for=""><img src="/img/iconos/skype_logo.png" height="17"> Skype</label>
					<input type="text" class="form-control" placeholder="Perfil de Skype" v-model="skype_url">
				</div>
				<button @click="editMeetInfo()" class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">
					Guardar Cambios
				</button>
			</div>


			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>Empresa</th>
							<th>Mensaje</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="mt-5 text-center" v-if="0 === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes agendamientos</p>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['user'],
		data() {
			return {
				hangouts_url: '',
				skype_url: '',
			}
		},
		created() {
			this.hangouts_url = this.user.hangouts_url
			this.skype_url = this.user.skype_url
		},
		methods: {
			editMeetInfo() {
				Swal.fire({
					title: '¿Deseas modificar datos de contacto?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {
							axios.post('profile/update-contact-info', {
								user_id: this.user.id,
								hangouts_url: this.hangouts_url,
								skype_url: this.skype_url
							})
								.then(res => {
									console.log(res)
									Swal.fire({title: res.data.message, type: 'success', timer:1500})
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: err.response.data.message, type: 'error', timer:1500})
								})
						}
					})
			}
		}
	}
</script>

<style>

</style>
