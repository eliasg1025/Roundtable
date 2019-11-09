<template>
	<div>
		<div @click="toggleSchedule" class="container mt-2 p-3">
			<button type="button" class="btn btn-add">
				<h4>Horarios disponibilidad</h4>
			</button>
			<br>
			<br>
			<admin-schedule id="admin-schedule" v-if="show_admin_schedule"/>
			<br>
			<hr>
		</div>
		<div class="container p-3">
			<div class="calendar-top">
				<button type="button" class="btn fc-button-primary" @click="toggleWeekends">Mostrar fines de semana</button>
				<!--
				<button @click="gotoPast">Click para regresar</button>
				(Regresa al 2000-01-01)
				<button @click="recuperarDatos">Recuperar datos</button>
				-->
			</div>
			<div v-if="loading_data" class="container p-5" >
				<spinner></spinner>
			</div>
			<FullCalendar
				v-else
				ref="fullCalendar"
				defaultView="timeGridWeek"
				:header="{
					left: 'prev, next, today',
					center: 'title',
					right: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek'
				}"
				:weekends="calendarWeekends"
				:plugins="calendarPlugins"
				:events="calendarEvents"
				:selectable="true"
				:locale="locale"
				@dateClick="handleDateClick"
			/>
		</div>
	</div>
</template>

<script>
	// Components
	import Spinner from './Spinner';
	import AdminSchedule from './AdminSchedule.vue';
	// Calendar
	import FullCalendar from "@fullcalendar/vue";
	import esLocale from "@fullcalendar/core/locales/es";
	import dayGridPlugin from '@fullcalendar/daygrid';
	import timeGridPlugin from "@fullcalendar/timegrid";
	import interactionPlugin from '@fullcalendar/interaction';
	
	export default {
		components: {
			AdminSchedule,
			FullCalendar,
			Spinner,
		},
		data() {
			return {
				// Calendar data
				calendarPlugins: [
					dayGridPlugin,
					timeGridPlugin,
					interactionPlugin,
				],
				calendarWeekends: true,
				calendarEvents: [],
				locale: esLocale,
				// Custom data
				loading_data: true,
				show_admin_schedule: false,
			}
		},
		mounted() {
			axios.get('/get-schedule')
				.then(res => {
					// console.log(res.data);
					this.calendarEvents = [...res.data];
					this.loading_data = false;
				})
				.catch(err => console.log(err.response));
		},
		computed: {
			calendarApi() {
				return this.$refs.fullCalendar.getApi()
			}
		},
		methods: {
			toggleWeekends() {
				this.calendarWeekends = !this.calendarWeekends
			},
			handleDateClick(arg) {
				console.log(arg);
				if (confirm('Deseas agregar un evento en: ' + arg.dateStr + ' ?')) {
					this.calendarEvents.push({
						title: 'New Event',
						start: arg.date,
						allDatay: arg.allDatay,
					})
				}
			},
			gotoPast() {
				this.calendarApi.gotoDate('2000-01-01')
			},
			recuperarDatos() {
				console.log(this.calendarApi.getEvents());
			},
			toggleSchedule() {
				if (!this.show_admin_schedule) {
					this.show_admin_schedule = true;
				}
			}
		}
	}
</script>

<style lang="scss">
	@import '~@fullcalendar/core/main.css';
	@import '~@fullcalendar/daygrid/main.css';
	@import '~@fullcalendar/timegrid/main.css';

	.calendar-top {
		margin: 0 0 3em;
	}

	.btn-toggle-schedule {
		border: 1px solid #ecec;
		background: #ececec;
	}
</style>
