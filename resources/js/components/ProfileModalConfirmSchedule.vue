<template>
	<div>
		<button
			class="btn btn-roundtable btn-block"
			data-toggle="modal"
			:data-target="'#confirmScheduleModal' + meeting.id"
		>
			Confirmar
		</button>
		<small class="text-muted">Confirmar de hora y fecha</small>

		<div
			class="modal fade"
			:id="'confirmScheduleModal' + meeting.id"
			tabindex="-1"
			role="dialog"
			aria-labelledby=""
			aria-hidden="true"
		>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="">
							Confirmar hora y fecha
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
						<h5>{{ calendar_event.title }}</h5>
						<hr />
						<div class="row">
							<div class="form-group col-md-6">
								<label class="h6">Fecha:</label>
								<input
									type="text"
									class="form-control"
									disabled
									v-model="calendar_event.date"
								/>
							</div>
							<div class="form-group col-md-6">
								<label class="h6">Hora:</label>
								<input
									type="text"
									class="form-control"
									disabled
									v-model="calendar_event.hour"
								/>
							</div>
						</div>
						<div class="form-group">
							<label class="h6">Zona horaria:</label>
							<input
								type="text"
								class="form-control"
								disabled
								v-model="calendar_event.timezone"
							/>
						</div>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-roundtable"
							@click="confirm"
						>
							Confirmar
						</button>
						<button
							type="button"
							class="btn btn-secondary"
							data-dismiss="modal"
						>
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["meeting"],
	data() {
		return {
			calendar_event: {}
		};
	},
	mounted() {
		let { id, title, date, timezone } = this.meeting;
		date = date.split(" ");
		this.calendar_event = {
			title,
			timezone,
			date: date[0],
			hour: date[1]
		};
		console.log(this.calendar_event);
	},
	methods: {
		confirm: function() {
			Swal.fire({
				title: "Enviando",
				onBeforeOpen: () => Swal.showLoading()
			});

			axios
				.post("/meet/response-request-meet", {
					meeting_id: this.meeting.id,
					operation: 1
				})
				.then(res => {
					console.log(res.data);
					Swal.fire({
						title: res.data.message,
						type: "success"
					}).then(res => {
						location.reload();
					});
				})
				.catch(err => console.log(err.response));
		}
	}
};
</script>

<style></style>
