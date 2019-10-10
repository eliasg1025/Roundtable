<template>
	<div :id="'eeadsas'+data_offer.offer.id" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Certificados de: {{ data_offer.offer.title }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!--  Btn agregar offer-cert -->
					<div class="container text-center" v-if="data_offer.certifications.length < 3">
						<button class="btn btn-add" data-toggle="modal" :data-target="'#modalAddOfferCert'+data_offer.offer.id">
							<i class="fas fa-plus"></i> Agregar Certificado
						</button>
						<br>
						<small class="mt-1">
							<span class="text-muted">Solo puedes agregar 3 certificados por producto.</span>
						</small>
					</div>
					<!-- End Btn -->
					<div class="table-responsive mt-3">
						<table class="table">
							<thead>
								<tr>
									<th>Título</th>
									<th>Documento</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="certification in data_offer.certifications" :key="certification.id">
									<td>
										<p>{{ certification.title }}</p>
									</td>
									<td>
										<span><a :href="certification.url" target="_blank"><i class="fas fa-search"></i> Ver</a></span>
									</td>
									<td>
										<div class="container mb-1 px-1">
											<button class="btn btn-primary btn-block"  data-toggle="modal" :data-target="'#certxadsad'+certification.id">
												Editar
											</button>
										</div>
										<div class="container mb-1 px-1">
											<button class="btn btn-danger btn-block" @click="deleteOfferCert(certification.id)">
												Eliminar
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="mt-3 text-center" v-if="data_offer.certifications.length === 0">
						<p style="color: #6C757D; font-size: 25px;">Este producto aún no tiene certificados.</p>
					</div>

					<!-- Modal Add OfferCert -->
					<div :id="'modalAddOfferCert'+data_offer.offer.id" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Agregar Certificación de Producto</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="">Titulo</label>
										<input type="text" class="form-control" placeholder="Nombre del certificado" v-model="title">
									</div>
									<div class="form-group">
										<label for="">Documento</label>
										<div class="custom-file">
											<input
												type="file" class="custom-file-input"
												id="addOfferCertFile" accept="application/pdf"
												ref="uploadFile"
												@change="handleFile()"
											>
											<label class="custom-file-label" for="addOfferCertFile"><i class="fas fa-file-pdf"></i> Selecciona un archivo(.pdf)</label>
											<small><span class="text-muted">Solamente se aceptará archivos de formato pdf</span></small>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-add" @click.prevent.stop="addOfferCert()">Agregar</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modals Edit OfferCert -->
					<modal-offer-cert-edit
						v-for="certification in data_offer.certifications" :key="certification.id"
						:certification="certification"
					></modal-offer-cert-edit>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import ModalOfferCertEdit from './ProfileModalOfferCertEdit.vue'

	export default {
		components: {
			ModalOfferCertEdit
		},
		props: [
			'data_offer',
		],
		data() {
			return {
				title: '',
				file: '',
				upload_file: '',
			}
		},
		methods: {
			handleFile() {
				this.upload_file = this.$refs.uploadFile.files[0]
			},
			addOfferCert() {
				let formData = new FormData()
				formData.append('offer_id', this.data_offer.offer.id)
				formData.append('title', this.title)
				formData.append('file', this.upload_file)

				// Comprobar el contenido del formData
				for (var key of formData.entries()) {
					console.log(key[0] + ', ' + key[1]);
				}

				const config = {
					headers: {'content-type': 'multipart/form-data'}
				}

				axios.post('/profile/add-product-cert', formData, config)
					.then(res => {
						console.log(res.data)
						Swal.fire({title: res.data.message, type: 'success', timer: 1500})
					})
					.catch(err => {
						console.log(err.response)
						Swal.fire({title: err.response.data.message, type: 'error', timer: 2000})
					})
			},
			deleteOfferCert(certification_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas eliminar el certificado de este producto?',
					text: 'Esta acción es irreversible',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {
							axios.delete(`/profile/delete-product-cert/${certification_id}`)
								.then(res => {
									console.log(res.data)
									Swal.fire({title: res.data.message, type: 'success', timer: 1500})
								})
								.catch(err => {
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
