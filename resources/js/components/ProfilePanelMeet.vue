<template>
	<div id="meet-panel" class="container">
		<h3>Agendamientos</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Gestiona tus agendamientos. Aquí podrás ver a las empresa que estan interesadas en tus productos y desean contactarse contigo.
			<br>
			<i><b>Solicitar un agendamiento</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a>.</i>
		</div>
		<div class="container">
			<div class="text-center panel-info-subtitle mt-4">
				<label class="text-uppercase h5">Datos para el agendamiento</label>
			</div>
			<div class="container">
				<div class="form-group">
					<label><img src="/img/iconos/hangout_logo.png" height="17"> Hangouts</label>
					<input type="text" class="form-control" placeholder="Perfil de Hangouts" v-model="hangouts_url">
				</div>
				<div class="form-group">
					<label><img src="/img/iconos/skype_logo.png" height="17"> Skype</label>
					<input type="text" class="form-control" placeholder="Perfil de Skype" v-model="skype_url">
				</div>
				<button @click="editMeetInfo()" class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">
					Guardar Cambios
				</button>
			</div>
			<!-- Horarios -->
			<div class="text-center panel-info-subtitle mt-5">
				<label class="text-uppercase h5">Horarios</label>
			</div>
			<div class="container">
				<a href="/schedule" class="btn btn-block btn-lg btn-save" style="margin-top: 25px;">
					Ver calendario
				</a>
			</div>
			<!-- End -->
			<br>
			<br>
			<hr>

			<div class="text-center panel-info-subtitle mt-5">
				<label class="text-uppercase h5">Recibidos</label>
			</div>
			<div class="table-responsive mt-1 table-meet">
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
						<tr v-for="data_meeting in data.received_meetings" :key="data_meeting.meeting.id" class="text-center">
							<td>
								<profile-modal-meet :data_meeting="data_meeting" type="received"/>
							</td>
							<td>
								<textarea
									rows="7"
									class="form-control meet-message"
									disabled
									v-model="data_meeting.meeting.message"
								></textarea>
							</td>
							<td>
								<p class="text-muted">
									Recibido {{ message_date(data_meeting.meeting.created_at) }}
								</p>
								<p class="meet-state">
									{{ data_meeting.state.name }}
								</p>
							</td>
							<td>
								<div class="container-button" v-if="data_meeting.state.id == 1">
									<div class="container mb-1">
										<button class="btn btn-success btn-block" @click="responseRequestMeet(data_meeting.meeting.id, 1)">Aceptar</button>
									</div>
									<div class="container mb-1">
										<button class="btn btn-danger btn-block" @click="responseRequestMeet(data_meeting.meeting.id, 0)">Rechazar</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 2">
									<div class="container mb-1">
										<button class="btn btn-danger disabled btn-block" disabled>Cancelado</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 3">
									<div class="container mb-1">
										<button class="btn btn-primary btn-block" disabled>Esperando</button>
									</div>
									<div class="container mb-1">
										<button class="btn btn-danger btn-block" @click="cancelMeet(data_meeting.meeting.id)">Cancelar</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 4">
									<button class="btn btn-success disabled btn-block" disabled>
										Esperando
									</button>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 5">
									<button class="btn btn-success disabled btn-block" disabled>
										Realizado
									</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mt-5 text-center" v-if="data.received_meetings.length === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes agendamientos recibidos</p>
			</div>
			
			<br>
			<br>
			<hr>

			<div class="text-center panel-info-subtitle mt-5">
				<label class="text-uppercase h5">Enviados</label>
			</div>
			<div class="table-responsive mt-1 table-meet">
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
						<tr v-for="data_meeting in data.sended_meetings" :key="data_meeting.id" class="text-center">
							<td>
								<profile-modal-meet :data_meeting="data_meeting" type="sended"/>
							</td>
							<td>
								<textarea
									rows="7"
									class="form-control meet-message"
									disabled
									v-model="data_meeting.meeting.message"
								></textarea>
							</td>
							<td>
								<p class="text-muted">
									Enviado {{ message_date(data_meeting.meeting.created_at) }}
								</p>
								<p class="meet-state">
									{{ data_meeting.state.name }}
								</p>
							</td>
							<td>
								<div class="container-button" v-if="data_meeting.state.id == 1">
									<div class="container mb-1">
										<button class="btn btn-secondary disabled btn-block" disabled>
											Por confirmar
										</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 2">
									<div class="container mb-1">
										<button class="btn btn-danger disabled btn-block" disabled>
											Cancelado
										</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 3">
									<div class="container mb-1">
										<button class="btn btn-primary btn-block" data-toggle="modal" :data-target="'#modalMeetingSchedule-'+data_meeting.meeting.id">
											Agendar
										</button>
										<!-- Modal -->
										<profile-modal-meet-schedule :data_meeting="data_meeting"/>
									</div>
									<div class="container mb-1">
										<button class="btn btn-danger btn-block" @click="cancelMeet(data_meeting.meeting.id)">Cancelar</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 4">
									<div class="container mb-1">
										<button class="btn btn-success disabled btn-block" disabled>
											Esperando
										</button>
									</div>
								</div>
								<div class="container-button" v-else-if="data_meeting.state.id == 5">
									<div class="container mb-1">
										<button class="btn btn-success disabled btn-block" disabled>
											Realizado
										</button>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mt-5 text-center" v-if="data.sended_meetings.length === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes agendamientos enviados</p>
			</div>
		</div>
	</div>
</template>

<script>
	import ProfileModalMeet from './ProfileModalMeet.vue';
	import ProfileModalMeetSchedule from './ProfileModalMeetSchedule.vue';

	export default {
		props: ['data', 'user'],
		components: {
			ProfileModalMeet,
			ProfileModalMeetSchedule,
		},
		data() {
			return {
				hangouts_url: '',
				skype_url: '',
			}
		},
		created() {
			this.hangouts_url = this.user.hangouts_url;
			this.skype_url = this.user.skype_url;
		},
		mounted() {
			Tippy.default('[data-tippy-content]');
		},
		methods: {
			message_date(date) {
				return Moment(date, "YYYY-MM-DD hh:mm:ss").fromNow()
			},
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
						if (res.value === true) {
							this.waitingAlert();

							axios.post('/profile/update-contact-info', {
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
			},
			responseRequestMeet(meet_id, operation) {

				if (operation === 0) {
					Swal.fire({
						title: '¿Desea rechazar esta solicitud?',
						text: 'Esta acción es irreversible',
						type: 'warning',
					})
						.then(res => {
							if (res.value)
								operate();
						})
				} else {
					Swal.fire({
						title: '¿Desea aceptar esta solicitud?',
						type: 'info'
					})
						.then(res => {
							if (res.value)
								operate();
						})
				}

				function operate() {
					Swal.fire({
						title: 'Cargando',
						onBeforeOpen: () => {
							Swal.showLoading();
						}
					})

					// ['aceptar', 'rechazar']

					axios.post('/meet/response-request-meet', {
						operation: operation,
						meet_id: meet_id,
					})
						.then(res => {
							console.log(res.data)
							Swal.fire({
								title: res.data.message,
								type: 'success',
								timer: 2000,
								showConfirmButton: false,
							})
								.then(res => location.reload())
						})
						.catch(err => {
							console.log(err.response.data)
						})
				}
			},
			cancelMeet(meet_id) {
				Swal.fire({
					title: '¿Realmente desea cancelar esta operación?',
					text: 'Esta operación es irreversible',
					type: 'warning',
				})
					.then(res => {
						if (res.value) {
							this.waitingAlert();

							axios.post('/meet/cancel-meet', {
								meet_id: meet_id,
							})
								.then(res => {
									console.log(res.data);
									
									Swal.fire({title: res.data.message, type: 'success', timer: 2500, showConfirmButton: false})
										.then(res => location.reload());
								})
								.catch(err => {
									console.log(err.response.data);
									Swal.fire({title: 'Error al cargar la operación, vuelva a cargar la página', type: 'error'})
								})
						}
					})
			},
			waitingAlert()
			{
				Swal.fire({
					title: 'Cargando',
					onBeforeOpen: () => {
						Swal.showLoading();
					}
				})
			}
		}
	}
</script>

<style>
	.table-meet > * {
		font-size: 14px;
	}
	.business-card-meet-table {
		width: 150px;
		margin: auto;
	}
	.container-button {
		width: 150px;
		font-size: 14px;
		margin: auto;
	}
	.meet-message {
		width: 310px;
		text-align: initial;
		font-size: 14px;
		resize: none;
	}
	.meet-state {
		background-color: #dadada;
		padding: 5px;
		border: 1px solid #b1b1b1;
		border-radius: 4px;
	}
	.mostrar-datos {
		font-size: 14px;
	}
</style>
