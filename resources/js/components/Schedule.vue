<template>
	<div class="container">
		
		<div class="container">
			<button type="button" @click="exportData()">Exportar datos</button>
		</div>
		<div>
			<div class="container p-5" v-show="loading_data">
				<spinner></spinner>
			</div>
			<div id="schedule" v-show="!loading_data"></div>
		</div>
	</div>
</template>

<script>
	import Spinner from './Spinner.vue';

	export default {
		components: {
			Spinner,
		},
		data() {
			return {
				loading_data: true,
			}
		},
		mounted() {
			$('#schedule').jqs({
				mode: 'edit',
				hour: 24,
				days: 7,
				periodDuration: 30,
				data: [],
				periodOptions: true,
				periodColors: [],
				periodTitle: '',
				periodBackgroundColor: 'rgba(82, 155, 255, 0.5)',
				periodBorderColor: '#2a3cff',
				periodTextColor: '#000',
				periodRemoveButton: 'Remove',
				periodDuplicateButton: 'Duplicate',
				periodTitlePlaceholder: 'Title',
				daysList: [
					'Lunes',
					'Martes',
					'Miercoles',
					'Jueves',
					'Viernes',
					'Sabado',
					'Domingo'
				],
				onInit: function () {},
				onAddPeriod: function () {},
				onRemovePeriod: function () {},
				onDuplicatePeriod: function () {},
				onClickPeriod: function () {}
			});

			setTimeout(() => {
				this.loading_data = false;
			}, 2000);
		},
		methods: {
			exportData() {
				let data = $('#schedule').jqs('export');
				console.log(data);
			}
		}
	}
</script>

<style>
	
</style>
