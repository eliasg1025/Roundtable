<template>
	<div>
		<!--
		<div
			class="p-3 mt-2"
			data-toggle="modal"
			data-target="#addModal"
			style="height: 100%; display: flex; align-items: center; justify-content: center;"
		>
			<button class="btn btn-add" style="width: 50%;">
				<i class="fas fa-plus"></i> Agregar Ratings
			</button>
		</div>-->

		<div
			class="modal"
			id="addRatingModal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="addAvalibleModal"
			aria-hidden="true"
		>
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body p-4 text-center">
						<div class="container d-flex">
							<button
								type="button"
								data-dismiss="modal"
								class="close"
								aria-label="Close"
								style="padding: 1rem 1rem; margin: -1rem -1rem -1rem auto;"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="text-center">
							<h5 class="modal-title h3">
								Califica a la empresa
							</h5>
							<!--<p class="display-4">{{ views }}</p>-->
						</div>
						<br />
						<div class="row">
							<star-rating
								:increment="0.5"
								text-class="custom-text"
								class="mx-auto"
							></star-rating>
						</div>
						<br />
						<div>
							<button
								@click="enviaCalif"
								class="btn btn-add btn-sm"
								style="width: 50%;"
							>
								Enviar
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Add AvalibleTime -->
</template>
<script>
export default {
	components: {},
	props: ["meeting"],
	data() {
		return {
			rating: 0
		};
	},
	methods: {
		enviaCalif() {
			console.log(this.rating);

			Swal.fire({
				title: "Enviando",
				onBeforeOpen: () => Swal.showLoading()
			});

			axios
				.post("/add-rating", {
					value: this.rating,
					meeting_id: this.meeting.id
				})
				.then(res => {
					console.log(res);
					Swal.fire({
						title: res.data.message,
						type: "success"
					}).then(res => location.replace("/profile"));
				})
				.catch(err => {
					console.log(err.response);
				});
		}
	}
};
</script>
