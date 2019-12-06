<template>
	<div>
		<div class="business-card-meet-table text-center">
			<div class="container">
				<img :src="data_meeting.other_user.profile_img" width="100%" />
			</div>
			<p class="my-2">
				<b>{{ data_meeting.other_user.commercial_name }}</b>
			</p>
			<hr />
			<a
				:href="'/business/profile/' + data_meeting.other_user.uuid"
				target="blank"
				class="my-2"
				><i class="fas fa-search"></i> Ver Perfil</a
			><br />
			<a
				v-if="can_view_data(data_meeting.state.id)"
				@click="activeModal(data_meeting.other_user.uuid)"
				role="button"
				data-toggle="modal"
				:data-target="
					'#previewInfoBusiness-' +
						data_meeting.meeting.id +
						'-' +
						type
				"
				href="#"
				class="my-2"
				><i class="fas fa-address-book"></i> Ver Datos</a
			>
		</div>
		<div v-if="can_view_data(data_meeting.state.id)">
			<!--Modal-->
			<div
				class="modal fade"
				:id="
					'previewInfoBusiness-' +
						data_meeting.meeting.id +
						'-' +
						type
				"
				tabindex="-1"
				role="dialog"
				:aria-labelledby="
					'previewInfoBusinessLabel-' + data_meeting.meeting.id
				"
				aria-hidden="true"
			>
				<div
					class="modal-dialog modal-lg modal-dialog-centered"
					role="document"
				>
					<div class="modal-content">
						<div class="modal-header">
							<h6
								class="modal-title"
								:id="
									'previewInfoBusinessLabel-' +
										data_meeting.meeting.id
								"
							>
								<img
									:src="data_meeting.other_user.profile_img"
									height="40px"
								/>
								<b>{{
									data_meeting.other_user.commercial_name
								}}</b>
								<span
									v-if="data_meeting.other_user.verified"
									class="is-verified"
									><i
										class="fas fa-check-circle"
										data-tippy-content="Empresa verificada"
									></i
								></span>
							</h6>
							<button
								type="button"
								class="close"
								data-dismiss="modal"
								aria-label="Close"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div
								v-if="modal_loading"
								class="text-center h6 p-4"
							>
								<i class="fas fa-spinner fa-spin"></i> Cargando
							</div>
							<div v-else>
								<div class="row">
									<div class="col-md-6">
										<div class="container p-3">
											<img
												:src="
													data_meeting.other_user
														.profile_img
												"
												width="100%"
												class="img-thumbnail"
											/>
										</div>
									</div>
									<div class="col-md-6">
										<div class="p-3">
											<div class="form-group row">
												<label
													class="col-sm-4 col-form-label"
													>Razón social</label
												>
												<div class="col-sm-8">
													<input
														type="text"
														class="form-control mostrar-datos"
														v-model="
															data_meeting
																.other_user.name
														"
														disabled
													/>
												</div>
											</div>
											<div class="form-group row">
												<label
													class="col-sm-4 col-form-label"
													>Nombre comercial</label
												>
												<div class="col-sm-8">
													<input
														type="text"
														class="form-control mostrar-datos"
														v-model="
															data_meeting
																.other_user
																.commercial_name
														"
														disabled
													/>
												</div>
											</div>
											<div class="form-group row">
												<label
													class="col-sm-4 col-form-label"
													>RUC</label
												>
												<div class="col-sm-8">
													<input
														type="text"
														class="form-control mostrar-datos"
														v-model="
															data_meeting
																.other_user.ruc
														"
														disabled
													/>
												</div>
											</div>
											<div class="form-group row">
												<label
													class="col-sm-4 col-form-label"
													>Partida registral</label
												>
												<div class="col-sm-8">
													<input
														type="text"
														class="form-control mostrar-datos"
														v-model="
															data_meeting
																.other_user
																.legal_registration
														"
														disabled
													/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-md-6">
										<fieldset>
											<legend>Datos de contacto</legend>
											<div class="p-3">
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"
														>Email</label
													>
													<div class="col-sm-8">
														<input
															type="text"
															class="form-control mostrar-datos"
															v-model="
																data_meeting
																	.other_user
																	.email
															"
															disabled
														/>
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"
														>Telefono</label
													>
													<div class="col-sm-8">
														<input
															type="text"
															class="form-control mostrar-datos"
															v-model="
																data_meeting
																	.other_user
																	.phone
															"
															disabled
														/>
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"
														>Dirección</label
													>
													<div class="col-sm-8">
														<input
															type="text"
															class="form-control mostrar-datos"
															v-model="
																data_meeting
																	.other_user
																	.address
															"
															disabled
														/>
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"
														>Hangouts</label
													>
													<div class="col-sm-8">
														<input
															type="text"
															class="form-control mostrar-datos"
															v-model="
																data_meeting
																	.other_user
																	.hangouts_url
															"
															disabled
														/>
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"
														>Skype</label
													>
													<div class="col-sm-8">
														<input
															type="text"
															class="form-control mostrar-datos"
															v-model="
																data_meeting
																	.other_user
																	.skype_url
															"
															disabled
														/>
													</div>
												</div>
											</div>
										</fieldset>
									</div>
									<div class="col-md-6">
										<fieldset>
											<legend>
												Horarios disponibles
											</legend>
											<div class="container p-3">
												<div
													v-for="avalible_time in avalible_times"
													:key="avalible_time.id"
													class="row pb-2 mb-2"
													style="border-bottom: 1px solid #ececec;"
												>
													<div class="col">
														<div
															v-for="day in avalible_time.daysOfWeek"
															:key="day.id"
															style="display: inline-block;"
															class="mb-1"
														>
															<span
																v-if="day.value"
																class="badge badge-info"
																>{{
																	day.name
																}}</span
															>&nbsp;
														</div>
														<br />
														<span
															>Desde:
															<b>{{
																format_hour(
																	avalible_time.startTime
																)
															}}</b></span
														>&nbsp;&nbsp;
														<span
															>Hasta:
															<b>{{
																format_hour(
																	avalible_time.endTime
																)
															}}</b></span
														>
													</div>
												</div>
												<div
													v-if="
														avalible_times.length ==
															0
													"
													class="p-4"
												>
													<p class="h5 text-muted">
														Aún no hay horarios
														asignados
													</p>
												</div>
											</div>
										</fieldset>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button
								type="button"
								class="btn btn-secondary"
								data-dismiss="modal"
							>
								Cerrar
							</button>
						</div>
					</div>
				</div>
			</div>
			<!--End Modal-->
		</div>
	</div>
</template>

<script>
export default {
	props: ["data_meeting", "type"],
	data() {
		return {
			modal_loading: true,
			they_can_view_data: [3, 4, 5],
			avalible_times: [],
			days: [
				{ id: 0, name: "Domingo", value: false },
				{ id: 1, name: "Lunes", value: false },
				{ id: 2, name: "Martes", value: false },
				{ id: 3, name: "Miércoles", value: false },
				{ id: 4, name: "Jueves", value: false },
				{ id: 5, name: "Viernes", value: false },
				{ id: 6, name: "Sábado", value: false }
			]
		};
	},
	methods: {
		can_view_data(state_id) {
			return this.they_can_view_data.indexOf(state_id) >= 0;
		},
		format_hour(date) {
			return Moment(date, "HH:mm").format("hh:mm a");
		},
		activeModal(user_uuid) {
			axios
				.get(`/get-avalible-time/${user_uuid}`, {
					user_uuid: user_uuid
				})
				.then(res => {
					this.avalible_times = [...res.data];
					this.avalible_times.forEach(avalible_time => {
						let daysOfWeek = avalible_time.daysOfWeek
							.split("")
							.map(item => parseInt(item));
						let newDays = [];

						this.days.forEach(day => {
							let newDay = {
								id: day.id,
								name: day.name,
								value: false
							};
							if (daysOfWeek.indexOf(day.id) > -1) {
								newDay.value = true;
							}
							newDays.push(newDay);
						});
						avalible_time.daysOfWeek = newDays;
					});
					this.modal_loading = false;
					// console.log(this.avalible_times);
				})
				.catch(err => {
					console.log(err.response);
				});
		}
	}
};
</script>

<style lang="scss"></style>
