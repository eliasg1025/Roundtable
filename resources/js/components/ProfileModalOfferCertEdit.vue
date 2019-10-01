<template>
	<div :id="'certxadsad'+certification.id"  class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Certificación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">Titulo del certificado</label>
						<input type="text" class="form-control" placeholder="Titulo del certificado" v-model="title">
					</div>
					<div>
						<label for="">Cambiar documento</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="editCertFile" accept="application/pdf">
							<label class="custom-file-label" for="editCertFile"><i class="fas fa-file-pdf"></i> Selecciona un archivo(.pdf)</label>
							<small><span class="text-muted">Solamente se aceptará archivos de formato pdf</span></small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click.prevent.stop="editOfferCert()">Guardar cambios</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['certification'],
		data() {
			return {
				title: '',
				url: '',
			}
		},
		created() {
			this.title = this.certification.title
			this.url = this.certification.url
		},
		methods: {
			editOfferCert() {
				Swal.fire({
					title: '¿Realmente deseas editar los datos de este certificado?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {
							console.log('Datos guardados')
						}
					})
			}
		}
	}
</script>

<style>

</style>