<template>
	<div>
		<div v-if="loading_data">
			<div class="container p-4"><spinner/></div>
		</div>
		<div v-else class="row mt-3">
			<div
				v-for="(avalible_time, index) in avalible_times" :key="avalible_time.id"
				class="col-md-6"
			>
				<div class="p-3 mt-2" style="border: 1px solid #ecec; border-radius: 6px;">
					<div class="d-flex justify-content-between align-items-center">
						<h5>Disponibilidad {{ index+1 }}</h5>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-secondary" @click="enableEdit(avalible_time.id)">Editar</button>
							<button type="button" class="btn btn-danger" @click="deleteAvalibleTime(avalible_time.id)">Eliminar</button>
						</div>
					</div>
					<br>
					<!-- Input Time -->
					<div class="row">
						<div class="form-group col-md-6 row">
							<label class="col-sm-4" :for="'inputStartTime'+avalible_time.id">Desde</label>
							<div class="col-sm-8">
								<input type="time" step="3600" :id="'inputStartTime'+avalible_time.id" v-model="avalible_time.startTime" :class="'form-control inputItem'+avalible_time.id" disabled>
							</div>
						</div>
						<div class="form-group col-md-6 row">
							<label class="col-sm-4" :for="'inputEndTime'+avalible_time.id">Hasta</label>
							<div class="col-sm-8">
								<input type="time" step="3600" :id="'inputEndTime'+avalible_time.id" v-model="avalible_time.endTime" :class="'form-control inputItem'+avalible_time.id" disabled>
							</div>
						</div>
					</div>
					<!-- Checkboxes -->
					<div class="container row">
						<div
							v-for="(day, index) in avalible_time.daysOfWeek" :key="index"
							class="custom-control custom-checkbox col-md-4"
						>
							<input type="checkbox" :class="'custom-control-input inputItem'+avalible_time.id" :id="'input'+avalible_time.id+'Day'+index" v-model="day.value" disabled>
							<label :for="'input'+avalible_time.id+'Day'+index" class="custom-control-label">{{ day.name }}</label>
						</div>
					</div>
					<!-- End -->
					<br>
					<button type="button" @click="editAvalibleTime(avalible_time.id)" :class="'btn btn-success btn-block inputItem'+avalible_time.id" style="display: none;" disabled>
						Guardar
					</button>
				</div>
				<!--<button type="button" @click="recuperarDatos(avalible_time.id)">Mostrar datos</button>-->
			</div>
			<!-- Add AvalibleTime --->
			<div class="col-md-6">
				<div class="p-3 mt-2" data-toggle="modal" data-target="#addAvalibleModal" style="height: 100%; display: flex; align-items: center; justify-content: center;">
					<button class="btn btn-add" style="width: 50%;"><i class="fas fa-plus"></i> Agregar horario</button>
				</div>
			</div>
			<!-- Modal Add AvalibleTime -->
			<div class="modal fade" id="addAvalibleModal" tabindex="-1" role="dialog" aria-labelledby="addAvalibleModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addAvalibleModalLabel">Agregar disponibilidad</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body p-4">
							<!-- Input Time -->
							<div class="row">
								<div class="form-group col-md-6 row">
									<label class="col-sm-4" for="">Desde</label>
									<div class="col-sm-8">
										<input type="time" id="" class="form-control inputItem" v-model="addStartTime">
									</div>
								</div>
								<div class="form-group col-md-6 row">
									<label class="col-sm-4" for="">Hasta</label>
									<div class="col-sm-8">
										<input type="time" id="" class="form-control inputItem" v-model="addEndTime">
									</div>
								</div>
							</div>
							<!-- Checkboxes -->
							<div class="container row mt-2">
								<div
									v-for="(day, index) in days" :key="index"
									class="custom-control custom-checkbox col-md-4"
								>
									<input type="checkbox" class="custom-control-input inputItem" :id="'checkboxDay'+day.id" v-model="day.value">
									<label :for="'checkboxDay'+day.id" class="custom-control-label">{{ day.name }}</label>
								</div>
							</div>
							<!-- End -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click="addAvalibleTime">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
</template>

<script>
	// Components
	import Spinner from './Spinner';

	export default {
		components: {
			Spinner,
		},
		data() {
			return {
				loading_data: true,
				avalible_times: [],
				days: [
					{ id: 0, name: 'Domingo', value: false },
					{ id: 1, name: 'Lunes', value: false },
					{ id: 2, name: 'Martes', value: false },
					{ id: 3, name: 'Miércoles', value: false },
					{ id: 4, name: 'Jueves', value: false },
					{ id: 5, name: 'Viernes', value: false },
					{ id: 6, name: 'Sábado', value: false },
				],
				addStartTime: '',
				addEndTime: '',
				daysOfWeek: [],
			}
		},
		mounted() {
			axios.get('/get-avalible-time')
				.then(res => {
					this.avalible_times = res.data;
					
					this.avalible_times.forEach(event => {
						let daysOfWeek = event.daysOfWeek.split('').map(item => parseInt(item));	
						let newDays = [];

						this.days.forEach(day => {
							let newDay = { id: day.id, name: day.name, value: false }
							if ( daysOfWeek.indexOf(day.id) > -1 ) {
								newDay.value = true
							}
							newDays.push(newDay);
						});
						event.daysOfWeek = newDays;
					});
					this.loading_data = false;
					// console.log(this.avalible_times);
				})
				.catch(err => console.log(err.response))
		},
		methods: {
			enableEdit(item_id) {
				let elements = document.getElementsByClassName(`inputItem${item_id}`);

				for (let i = 0; i < elements.length; i++) {
					if (elements[i].disabled) {
						elements[i].disabled = false;
						let buttonEdit = document.querySelector(`button.inputItem${item_id}`).style.display = '';
					} else {
						elements[i].disabled = true;
						let buttonEdit = document.querySelector(`button.inputItem${item_id}`).style.display = 'none';
					}
					
				}
			},
			editAvalibleTime(item_id) {
				Swal.fire({title: '¿Deseas editar este elemento?', type: 'info'})
					.then(res => {
						if (res.value) {

							Swal.fire({title: 'Enviando', onBeforeOpen: () => Swal.showLoading()});

							axios.post('/edit-avalible-time', {
								item_id: item_id,
								data: this.recuperarDatos(item_id),
							})
								.then(res => {
									console.log(res.data);
									this.messageSuccess(res.data);
								})
								.catch(err => console.log(err.reponse))
						}
					})
					.catch(err => console.log(err.reponse))
			},
			recuperarDatos(item_id) {
				let startTime = document.getElementById(`inputStartTime${item_id}`).value;
				let endTime = document.getElementById(`inputEndTime${item_id}`).value;

				let selectedDays = [];

				for (let i = 0; i < this.days.length; i++) {
					selectedDays[i] = {
						id: i,
						value: document.getElementById(`input${item_id}Day${i}`).checked,
					}
				}
				
				let data = {
					startTime: startTime,
					endTime: endTime,
					selectedDays: selectedDays,
				}
				console.log(item_id, data);

				return data;
			},
			deleteAvalibleTime(item_id) {
				Swal.fire({title: '¿Deseas eliminar este horario?', type: 'info', showCancelButton: true})
					.then(res => {
						if (res.value) {
							Swal.fire({title: 'Enviando', onBeforeOpen: () => Swal.showLoading()});

							axios.post('/delete-avalible-time', {
								item_id: item_id,
							})
								.then(res => {
									console.log(res.data);
									this.messageSuccess(res.data);
								})
								.catch(err => console.log(err.reponse));
						}
					})
			},
			messageSuccess(data) {
				Swal.fire({
					title: data.message,
					type: 'success',
					timer: 2000,
					showConfirmButton: false,
				})
					.then(res => location.reload())
			},
			addAvalibleTime() {

				if (this.addStartTime !== '' || this.addEndTime !== '') {

					Swal.fire({title: 'Esperando', onBeforeOpen: () => Swal.showLoading()});

					axios.post('/add-avalible-time', {
						startTime: this.addStartTime,
						endTime: this.addEndTime,
						daysOfWeek: this.days,
					})
						.then(res => {
							console.log(res.data);
							this.messageSuccess(res.data);
						})
						.catch(err => {
							console.log(err.reponse);
						})
				} else {
					Swal.fire({
						title: 'Debes completar todos los campos',
						type: 'info',
					})
				}

			}
		}
	}
</script>

<style lang="scss">
	
</style>
