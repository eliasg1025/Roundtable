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
							<input
								type="file" class="custom-file-input"
								id="editCertFile" accept="application/pdf"
								ref="offerCert"
								@change="handleOfferCert()"
							>
							<label class="custom-file-label" for="editCertFile"><i class="fas fa-file-pdf"></i> {{ upload_offer_cert_name }}</label>
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
				upload_offer_cert: [],
				upload_offer_cert_name: ''
			}
		},
		created() {
			this.upload_offer_cert_name = 'Selecciona un archivo(.pdf)'
			this.title = this.certification.title
			this.url = this.certification.url
		},
		methods: {
			handleOfferCert() {
				this.upload_offer_cert = this.$refs.offerCert.files[0]
				this.upload_offer_cert_name = this.upload_offer_cert.name
			},
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
							let formData = new FormData()
							formData.append('file', this.upload_offer_cert)
							formData.append('title', this.title)
							
							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}
							axios.post(`/profile/edit-product-cert/${this.certification.id}`, formData, config)
								.then(res => {
									console.log(res.data)
									Swal.fire({title: res.data.message, type: 'success', timer: 1500})
										.then(res => location.reload())
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: err.response.data.message, type: 'error', timer: 2000})
								})
						}
					})
			}
		}
	}
</script>

<style>

</style>
