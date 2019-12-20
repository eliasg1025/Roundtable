<template>
	<div
		class="modal fade"
		id="modalAgendar"
		tabindex="-1"
		role="dialog"
		aria-hidden="true"
	>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Agendar Reunión
					</h5>
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
					<form-wizard
						@on-complete="sendMeeting"
						@on-loading="setLoading"
						@on-validate="handleValidation"
						@on-error="handleErrorMessage"
						title="Agendar fecha y hora"
						:subtitle="data_user.commercial_name"
						color="#88BE2E"
						nextButtonText="Siguiente"
						backButtonText="Atras"
						finishButtonText="Finalizar"
					>
						<tab-content
							title="Mensaje (opcional)"
							:before-change="validateZeroStep"
						>
							<div class="row">
								<div class="col-md-6">
									<p class="form-destinity">De:</p>
									<div class="business-meet-card text-center">
										<div class="container py-3">
											<img
												:src="
													data_visit_user.data
														.profile_img
												"
												width="100%"
											/>
										</div>
									</div>
									<div class="business-meet-name container">
										<p class="my-2 text-center">
											{{
												data_visit_user.data
													.commercial_name
											}}
										</p>
									</div>
								</div>
								<div class="col-md-6">
									<p class="form-destinity second">Para:</p>
									<div class="business-meet-card text-center">
										<div class="container py-3">
											<img
												:src="data_user.profile_img"
												width="100%"
											/>
										</div>
									</div>
									<div class="business-meet-name container">
										<p class="my-2 text-center">
											{{ data_user.commercial_name }}
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group mt-3">
										<label for="">Mensaje:</label>
										<textarea
											class="form-control"
											id=""
											rows="4"
											placeholder="Deja tu mensaje para esta empresa. (Opcional)"
											v-model="message"
											maxlength="255"
										></textarea>
										<small class="mt-1">
											<span class="text-muted"
												>Máximo 255 caracteres:
												{{ length_message }}/255</span
											>
										</small>
									</div>
								</div>
							</div>
						</tab-content>

						<tab-content
							title="Horario"
							:before-change="validateFirstStep"
						>
							<div class="container" v-if="loading">
								<spinner />
							</div>
							<div v-else class="text-center">
								<hr />
								<p class="h6"><b>Selecciona un horario: </b></p>
								<div
									v-for="avalible_time in avalible_times"
									:key="avalible_time.id"
									class="row py-2 my-2"
								>
									<div class="col-md-12">
										<input
											type="radio"
											class="checkbox-schedule d-none"
											autocomplete="off"
											name="checkbox-schedule"
											:id="
												'checkboxSchedule-' +
													avalible_time.id
											"
											:value="avalible_time.id"
											v-model="selected_avalible_time"
										/>
										<button
											@click="
												checkRadioSchedule(
													avalible_time.id
												)
											"
											type="button"
											class="btn btn-light checkbox-schedule__button"
										>
											<div
												v-for="day in avalible_time.daysOfWeek"
												:key="day.id"
												class="d-inline-block mb-1"
											>
												<span
													v-if="day.value"
													href="#"
													class="badge badge-info"
													>{{ day.name }}</span
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
										</button>
									</div>
								</div>
							</div>
						</tab-content>

						<tab-content
							title="Fecha"
							:before-change="validateSecondStep"
							class="text-center"
						>
							<hr />
							<p class="h6 "><b>Fechas próximas: </b></p>
							<div class="row py-2 my-2">
								<div class="col-md-12">
									<div
										v-for="possibleDay in possibleDays"
										:key="possibleDay.date"
										class="d-inline-block p-2"
									>
										<input
											type="radio"
											class="radio-button-day d-none"
											name="radioSelectDay"
											autocomplete="off"
											:id="
												'radioSelectDay-' +
													possibleDay.date
											"
											:value="possibleDay.date"
										/>
										<button
											@click="
												checkRadioDay(possibleDay.date)
											"
											type="button"
											class="btn p-0 radio-button-day__button"
										>
											<ul class="list-group">
												<li
													class="list-group-item active"
												>
													<span
														class="text-uppercase"
														>{{
															possibleDay.shortName
														}}</span
													>
												</li>
												<li class="list-group-item">
													<b
														>{{ possibleDay.date }}
														/
														{{
															possibleDay.month
														}}</b
													>
												</li>
											</ul>
										</button>
									</div>
								</div>
							</div>
						</tab-content>

						<tab-content
							title="Hora"
							:before-change="validateThirdStep"
							class="text-center"
						>
							<hr />
							<p class="h6 "><b>Horas disponibles: </b></p>
							<div class="row py-2 my-2">
								<div class="col-md-12">
									<div
										v-for="possibleHour in possibleHours"
										:key="possibleHour.id"
										class="d-inline-block p-2"
									>
										<input
											type="radio"
											class="radio-button-hour d-none"
											name="radioSelectHour"
											autocomplete="off"
											:id="
												'radioSelectHour-' +
													possibleHour.id
											"
											:value="possibleHour.id"
										/>
										<button
											@click="
												checkRadioHour(possibleHour.id)
											"
											type="button"
											class="btn btn-primary radio-button-hour__button"
										>
											{{ possibleHour.hour_a }}
										</button>
									</div>
								</div>
							</div>
						</tab-content>

						<div class="loader" v-if="loadingWizard">
							<spinner />
						</div>
						<div v-if="errorMsg">
							<span class="error">{{ errorMsg }}</span>
						</div>
					</form-wizard>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
// window.Intl.DateTimeFormat().resolvedOptions();
import { FormWizard, TabContent } from "vue-form-wizard";

export default {
	components: {
		FormWizard,
		TabContent
	},
	name: "modal-agendar",
	props: ["data_user", "data_visit_user"],
	data() {
		return {
			avalible_times: [],
			sender_has_available_time: false,
			receiver_has_available_time: false,
			amount_next_days: 5,
			loading: true,
			days: [
				{ id: 0, name: "Domingo", shortName: "dom", value: false },
				{ id: 1, name: "Lunes", shortName: "lun", value: false },
				{ id: 2, name: "Martes", shortName: "mar", value: false },
				{ id: 3, name: "Miércoles", shortName: "mie", value: false },
				{ id: 4, name: "Jueves", shortName: "jue", value: false },
				{ id: 5, name: "Viernes", shortName: "vie", value: false },
				{ id: 6, name: "Sábado", shortName: "sab", value: false }
			],
			// Wizard state
			loadingWizard: false,
			errorMsg: null,

			// Form datas
			possibleDays: "",
			possibleHours: [],
			selected_avalible_time: "",
			selected_day: "",
			selected_hour: "",
			message: ""
		};
	},
	computed: {
		length_message() {
			return this.message.length;
		}
	},
	mounted() {
		axios
			.get(
				`/check-available-time/${this.data_visit_user.data.uuid}/${this.data_user.uuid}`
			)
			.then(res => {
				console.log(res.data);
				let {
					count_sender_available_time,
					count_receiver_available_time,
					receiver_available_time
				} = res.data;

				this.sender_has_available_time =
					count_sender_available_time > 0;

				this.receiver_has_available_time =
					count_receiver_available_time > 0;

				this.avalible_times = [...receiver_available_time];
				this.avalible_times.forEach(avalible_time => {
					let daysOfWeek = avalible_time.daysOfWeek
						.split("")
						.map(item => parseInt(item));
					let newDays = [];

					this.days.forEach(day => {
						let newDay = {
							id: day.id,
							name: day.name,
							shortName: day.shortName,
							value: false
						};
						if (daysOfWeek.indexOf(day.id) > -1) {
							newDay.value = true;
						}
						newDays.push(newDay);
					});
					avalible_time.daysOfWeek = newDays;
				});
				this.loading = false;
			})
			.catch(err => console.log(err));
	},
	methods: {
		format_hour(date) {
			return Moment(date, "HH:mm").format("hh:mm a");
		},
		cleanRadioDayButtons() {
			let radio_buttons = document.getElementsByName("radioSelectDay");
			for (let i = 0; i < radio_buttons.length; i++) {
				radio_buttons[i].checked = false;
			}
			this.selected_day = "";
		},
		cleanRadioHourButtons() {
			let radio_buttons = document.getElementsByName("radioSelectHour");
			for (let i = 0; i < radio_buttons.length; i++) {
				radio_buttons[i].checked = false;
			}
			this.possibleHours = [];
		},
		checkRadioSchedule(avalible_time_id) {
			document.getElementById(
				`checkboxSchedule-${avalible_time_id}`
			).checked = true;
		},
		checkRadioDay: function(date_id) {
			document.getElementById(`radioSelectDay-${date_id}`).checked = true;
		},
		checkRadioHour: function(hour_id) {
			document.getElementById(
				`radioSelectHour-${hour_id}`
			).checked = true;
		},
		setLoading: function(value) {
			this.loadingWizard = value;
		},
		handleValidation: function(isValid, tabIndex) {
			console.log("Tab: " + tabIndex + " valid: " + isValid);
		},
		handleErrorMessage: function(errorMsg) {
			this.errorMsg = errorMsg;
		},
		// Actions to validate data
		validateZeroStep() {
			return new Promise((resolve, reject) => {
				if (this.receiver_has_available_time) {
					if (this.sender_has_available_time) {
						resolve(true);
					} else {
						reject(
							"Para futuros agendamiento necesita desginar horarios disponibles"
						);
					}
				} else {
					reject(
						"El usuario no tiene horarios disponibles asignados"
					);
				}
			});
		},
		validateFirstStep() {
			// El elemento seleccionado del checkbox es guardado en la vaiable "selected_avalible_time"
			let data = document.getElementsByName("checkbox-schedule");
			for (let i = 0; i < data.length; i++) {
				if (data[i].checked) {
					this.selected_avalible_time = data[i].value;
					break;
				}
			}

			return new Promise((resolve, reject) => {
				if (this.selected_avalible_time === "") {
					reject("Debe seleccionar una de las opciones");
				} else {
					let daysOfWeek;
					this.avalible_times.forEach(el => {
						if (el.id == this.selected_avalible_time)
							daysOfWeek = el.daysOfWeek;
					});
					daysOfWeek = daysOfWeek.filter(el => el.value === true);
					// console.log('daysOfWeek:', daysOfWeek);

					// Funcion que hace aumentar el dia de uno en uno
					function getNextDay(date) {
						return new Date(date.setDate(date.getDate() + 1));
					}

					// Variable local
					let possibleDays = [];
					let today = new Date();
					for (let i = 0; i < 15; i++) {
						let next_day = getNextDay(today);
						possibleDays.push({
							date: next_day.getDate(),
							day: next_day.getDay(),
							month: next_day.getMonth(),
							year: next_day.getFullYear()
						});
					}

					// Guarda solo las fechas disponible segun horario ademas añade el nombre del dia
					possibleDays = possibleDays
						.filter(possibleDay => {
							return (
								daysOfWeek.findIndex(
									el => el.id == possibleDay.day
								) !== -1
							);
						})
						.map(possibleDay => {
							let dayOfWeek = daysOfWeek.find(
								el => el.id == possibleDay.day
							);
							return {
								...possibleDay,
								name: dayOfWeek.name,
								shortName: dayOfWeek.shortName
							};
						});

					// console.log(possibleDays);

					// Si la cantidad de dias posibles es mayor a 5 se seleccionan como maximo 5, caso contario se toman todos
					this.possibleDays =
						possibleDays.length >= 5
							? [...possibleDays.splice(0, 5)]
							: [...possibleDays];
					this.cleanRadioDayButtons();

					// Resolve promise
					resolve(true);
				}
			});
		},
		validateSecondStep() {
			let data = document.getElementsByName("radioSelectDay");
			let selected_day_id;
			for (let i = 0; i < data.length; i++) {
				if (data[i].checked) {
					selected_day_id = data[i].value;
					break;
				}
			}

			return new Promise((resolve, reject) => {
				if (!selected_day_id) {
					reject("Debe seleccionar una de las opciones");
				} else {
					this.selected_day = this.possibleDays.find(
						possibleDay => possibleDay.date == selected_day_id
					);

					let data = this.avalible_times.find(
						el => el.id == this.selected_avalible_time
					);

					let startTime = parseInt(
						Moment(data.startTime, "HH:mm").format("HHmm")
					);
					let endTime = parseInt(
						Moment(data.endTime, "HH:mm").format("HHmm")
					);
					let difference = (endTime - startTime) / 100;

					// Clean radio buttons
					this.cleanRadioHourButtons();

					for (let i = 0; i < difference; i++) {
						this.possibleHours.push(startTime + 100 * i);
					}

					this.possibleHours = this.possibleHours.map(
						(hour, index) => {
							if (hour < 1000) {
								hour = "0" + hour;
							}
							return {
								id: index,
								hour_a: Moment(hour, "HHmm").format("hh:mm a"),
								hour: Moment(hour, "HHmm").format("HH:mm:ss")
							};
						}
					);

					console.log(this.possibleHours);

					resolve(true);
				}
			});
		},
		validateThirdStep() {
			let data = document.getElementsByName("radioSelectHour");
			let selected_hour_id;
			for (let i = 0; i < data.length; i++) {
				if (data[i].checked) {
					selected_hour_id = data[i].value;
					break;
				}
			}
			return new Promise((resolve, reject) => {
				if (!selected_hour_id) {
					reject("Debe seleccionar una de las opciones");
				} else {
					this.selected_hour = this.possibleHours.find(
						possibleHour => possibleHour.id == selected_hour_id
					);
					// this.cleanRadioHourButtons();
					resolve(true);
				}
			});
		},
		sendMeeting() {
			Swal.fire({
				title: "Estas consumiendo 10 coins en esta operación",
				text: "¿Deseas continuar?",
				type: "info",
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Si",
				cancelButtonText: "Cancelar",
				showCancelButton: true
			})
				.then(res => {
					if (res.value === true) {
						Swal.fire({
							title: "Enviando",
							onBeforeOpen: () => Swal.showLoading()
						});

						axios
							.post("/business/create-meet", {
								receiver_id: this.data_user.id,
								sender_id: this.data_visit_user.data.id,
								message: this.message,
								day: this.selected_day,
								hour: this.selected_hour
							})
							.then(res => {
								console.log(res.data);
								Swal.fire({
									title: "Agendamiento creado exitosamente",
									type: "success",
									html:
										"Se ha enviado un correo de confirmación a la otra empresa, una vez <b>confirme la hora y fecha</b> se podrá realizar la reunión virtual",
									confirmButtonColor: "#88be2e"
								}).then(res => {
									location.reload();
								});
							})
							.catch(err =>
								Swal.fire({
									title: err.response.data.message,
									type: "error"
								})
							);
					}
				})
				.catch(err => console.log(err.response));
		}
	}
};
</script>

<style lang="scss">
@import "~vue-form-wizard/dist/vue-form-wizard.min.css";

.checkbox-schedule:checked + .checkbox-schedule__button {
	background-color: #e2e6ea;
	border-color: #dae0e5;
	transform: scale(1.1);
}

.radio-button-day:checked + .radio-button-day__button {
	transform: scale(1.1);
	box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
}

.radio-button-hour:checked + .radio-button-hour__button {
	transform: scale(1.1);
	box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
}

span.error {
	color: #e74c3c;
	font-size: 20px;
	display: flex;
	justify-content: center;
}
</style>
