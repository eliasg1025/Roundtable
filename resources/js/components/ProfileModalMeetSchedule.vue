<template>
	<div class="modal fade" :id="'modalMeetingSchedule-'+data_meeting.meeting.id" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<form-wizard
						@on-complete="sendMeetingToQueue"
						@on-loading="setLoading"
						@on-validate="handleValidation"
                  		@on-error="handleErrorMessage"
						title="Agendar fecha y hora"
						:subtitle="data_meeting.other_user.commercial_name"
						color="#88BE2E"
						nextButtonText="Siguiente"
						backButtonText="Atras"
						finishButtonText="Finalizar"
					>

						<tab-content title="Horario" :before-change="validateFirstStep">
							<div class="container" v-if="loading">
								<spinner/>
							</div>
							<div v-else>
								<hr>
								<p class="h6 "><b>Selecciona un horario: </b></p>
								<div v-for="avalible_time in avalible_times" :key="avalible_time.id" class="row py-2 my-2">
									<div class="col-md-12">
										<input
											type="radio" class="checkbox-schedule d-none" autocomplete="off" name="checkbox-schedule"
											:id="'checkboxSchedule-'+avalible_time.id+'-meeting-'+data_meeting.meeting.id"
											:value="avalible_time.id" v-model="selected_avalible_time"
										/>
										<button @click="checkRadioSchedule(avalible_time.id, data_meeting.meeting.id)" type="button" class="btn btn-light checkbox-schedule__button">
											<div v-for="day in avalible_time.daysOfWeek" :key="day.id" style="display: inline-block;" class="mb-1">
												<span v-if="day.value" href="#" class="badge badge-info">{{ day.name }}</span>&nbsp;
											</div>
											<br>
											<span>Desde: <b>{{ format_hour(avalible_time.startTime) }}</b></span>&nbsp;&nbsp;
											<span>Hasta: <b>{{ format_hour(avalible_time.endTime) }}</b></span>
										</button>
									</div>
								</div>
							</div>
						</tab-content>

						<tab-content title="Fecha" :before-change="validateSecondStep">
							<hr>
							<p class="h6 "><b>Fechas próximas: </b></p>
							<div class="row py-2 my-2">
								<div class="col-md-12">
									<div v-for="possibleDay in possibleDays" :key="possibleDay.date" style="display: inline-block;" class="p-2">
										<input
											type="radio" class="radio-button-day" name="radioSelectDay" autocomplete="off"
											:id="'radioSelectDay-'+possibleDay.date"
											:value="possibleDay.date"
										>
										<button @click="checkRadioDay(possibleDay.date)" type="button" class="btn p-0 radio-button-day__button">
											<ul	class="list-group">
												<li class="list-group-item active"><span class="text-uppercase">{{ possibleDay.shortName }}</span></li>
												<li class="list-group-item"><b>{{ possibleDay.date }} / {{ possibleDay.month }}</b></li>
											</ul>
										</button>
									</div>
								</div>
							</div>
						</tab-content>

						<tab-content title="Hora">
							<hr>
							<p class="h6 "><b>Horas disponibles: </b></p>
						</tab-content>
						
						<div class="loader" v-if="loadingWizard">
							<spinner/>
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
	import { FormWizard, TabContent } from 'vue-form-wizard';

	export default {
		components: {
			FormWizard,
			TabContent,
		},
		props: ['data_meeting'],
		data() {
			return {
				avalible_times: [],
				amount_next_days: 5,
				loading: true,
				days: [
					{ id: 0, name: 'Domingo', shortName: 'dom', value: false },
					{ id: 1, name: 'Lunes', shortName: 'lun', value: false },
					{ id: 2, name: 'Martes', shortName: 'mar', value: false },
					{ id: 3, name: 'Miércoles', shortName: 'mie', value: false },
					{ id: 4, name: 'Jueves', shortName: 'jue', value: false },
					{ id: 5, name: 'Viernes', shortName: 'vie', value: false },
					{ id: 6, name: 'Sábado', shortName: 'sab', value: false },
				],
				// Wizard state
				loadingWizard: false,
         		errorMsg: null,

				// Form datas
				possibleDays: '',
				selected_avalible_time: '',
				selected_day: '',
				selected_hour: '',
			}
		},
		mounted() {
			axios.get(`/get-avalible-time/${this.data_meeting.other_user.uuid}`)
				.then(res => {
					this.avalible_times = [...res.data];
					this.avalible_times.forEach(avalible_time => {
						
						let daysOfWeek = avalible_time.daysOfWeek.split('').map(item => parseInt(item));
						let newDays = [];

						this.days.forEach(day =>  {
							let newDay = { id: day.id, name: day.name, shortName:day.shortName, value: false }
							if ( daysOfWeek.indexOf(day.id) > -1 ) {
								newDay.value = true
							}
							newDays.push(newDay);
						});
						avalible_time.daysOfWeek = newDays;
					});
					this.loading = false;
					// console.log(this.avalible_times);

				})
				.catch(err => console.log(err.response));

			console.log('Fecha actual: ',this.soon_days);
		},
		methods: {
			format_hour(date) {
				return Moment(date, 'HH:mm').format('hh:mm a');
			},
			cleanRadioDayButtons() {
				let radio_buttons = document.getElementsByName('radioSelectDay');
				for (let i = 0; i < radio_buttons.length; i++) {
					radio_buttons[i].checked = false;
				}
				this.selected_day = '';
			},
			checkRadioSchedule(avalible_time_id, meeting_id) {
				document.getElementById(`checkboxSchedule-${avalible_time_id}-meeting-${meeting_id}`).checked = true;
			},
			checkRadioDay: function(date_id) {
				document.getElementById(`radioSelectDay-${date_id}`).checked = true;
			},
			setLoading: function(value) {
				this.loadingWizard = value
			},
			handleValidation: function(isValid, tabIndex){
				console.log('Tab: '+tabIndex+ ' valid: '+isValid)
			},
			handleErrorMessage: function(errorMsg){
				this.errorMsg = errorMsg
			},
			validateFirstStep() {
				// El elemento seleccionado del checkbox es guardado en la vaiable "selected_avalible_time"
				let data = document.getElementsByName('checkbox-schedule');
				for (let i = 0; i < data.length; i++) {
					if ( data[i].checked ) {
						this.selected_avalible_time = data[i].value;
						break;
					}
				}

				let daysOfWeek;
				this.avalible_times.forEach(el => {
					if (el.id == this.selected_avalible_time)
						daysOfWeek = el.daysOfWeek
				})
				daysOfWeek =  daysOfWeek.filter(el =>  el.value === true);
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
						year: next_day.getFullYear(),
					})
				}

				// Guarda solo las fechas disponible segun horario ademas añade el nombre del dia
				possibleDays = possibleDays.filter(possibleDay => {
												return  daysOfWeek.findIndex(el => el.id == possibleDay.day) !== -1
											})
											.map(possibleDay => {
												let dayOfWeek = daysOfWeek.find(el => el.id == possibleDay.day);
												return {
													...possibleDay,
													name: dayOfWeek.name,
													shortName: dayOfWeek.shortName,
												}
											})
				
				// console.log(possibleDays);

				// Si la cantidad de dias posibles es mayor a 5 se seleccionan como maximo 5, caso contario se toman todos
				this.possibleDays = possibleDays.length >= 5 ? [...possibleDays.splice(0, 5)] : [...possibleDays];
				this.cleanRadioDayButtons();

				return new Promise((resolve, reject) => {
					if (this.selected_avalible_time === '') {
						reject('Debe seleccionar una de las opciones');
					} else {
						resolve(true);
					}
				})
			},
			validateSecondStep() {
				let data = document.getElementsByName('radioSelectDay');
				let selected_day_id;
				for (let i = 0; i < data.length; i++) {
					if ( data[i].checked ) {
						selected_day_id = data[i].value;
						break;
					}
				}

				this.selected_day = this.possibleDays.find(possibleDay => possibleDay.date == selected_day_id);

				return new Promise((resolve, reject) => {
					if (this.selected_day === '') {
						reject('Debe seleccionar una de las opciones');
					} else {
						resolve(true);
					}
				})
			},
			validateThirdStep() {

			},
			sendMeetingToQueue() {
				alert('Success');
			}
		}
	}
</script>

<style lang="scss">
	@import '~vue-form-wizard/dist/vue-form-wizard.min.css';

	.checkbox-schedule:checked + .checkbox-schedule__button {
		background-color: #e2e6ea;
		border-color: #dae0e5;
		transform: scale(1.1);
	}

	.radio-button-day:checked + .radio-button-day__button {
		transform: scale(1.1);
		box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
	}

	span.error{
		color:#e74c3c;
		font-size:20px;
		display:flex;
		justify-content:center;
	}
</style>
