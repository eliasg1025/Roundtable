<template>
	<div id="cert-panel" class="container">
		<h3>Certificaciones</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Añade las certificaciones o acreditaciones de tu empresa. Dependiendo de tu plan puedes añadir cierta cantidad de certificaciones en formato pdf.
			<br>
			<i>Subir <b>una certificación</b> te cuesta <a href="/planes" target="_blank"><b>20 coins</b></a></i>.
		</div>
		<!-- Btn para agregar productos -->
		<div class="container text-center">
			<button class="btn btn-add" data-toggle="modal" data-target="#modalAddCert">
				<i class="fas fa-plus"></i> Agregar Certificación
			</button>
			<br>
			<small class="mt-1">
				<span class="text-muted">Esta operación cuesta 20 coins. <a href="/planes" target="_blank">Conseguir coins.</a></span>
			</small>
		</div>
		<div class="container">
			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>Título</th>
							<th>Certificado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="cert in certifications" :key="cert.id">
							<td>
								<p style="font-family: 'Roboto', sans-serif;">{{ cert.title }}</p>
							</td>
							<td>
								<a
									:href="cert.url" target="_blank"
									class="btn btn-light btn-cert text-center" style="border: 1px solid #cecece;"
								>
									<span style="margin: auto;"><i class="fas fa-file-pdf" style="color: rgb(213, 72, 65);"> </i> Ver certificado</span>
								</a>
							</td>
							<td>
								<div class="container mb-1">
									<button class="btn btn-primary btn-block" data-toggle="modal" :data-target="'#certfasd'+cert.id">
										Editar
									</button>
								</div>
								<div class="container">
									<button class="btn btn-danger btn-block" @click="deleteCert(cert.id)">Eliminar</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mt-5 text-center" v-if="certifications.length === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes certificados subidos</p>
			</div>
		</div>

		<!-- Modal Add Cert -->
		<div id="modalAddCert" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Agregar Certificación</h5>
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
									id="addCertFile" accept="application/pdf"
									ref="uploadCert"
									@change="handleCert()"
								>
								<label class="custom-file-label" for="addCertFile"><i class="fas fa-file-pdf"></i> Selecciona un archivo(.pdf)</label>
								<small><span class="text-muted">Solamente se aceptará archivos de formato pdf</span></small>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-add" @click="addCert()">Agregar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modals Edit Cert -->
		<modal-cert-edit
			v-for="certification in certifications" :key="certification.id"
			:certification="certification"
		></modal-cert-edit>
	</div>
</template>

<script>
	import ModalCertEdit from './ProfileModalCertEdit.vue';

	export default {
		components: {
			ModalCertEdit
		},
		props: [
			'certifications',
		],
		data() {
			return {
				title: '',
				upload_cert: ''
			}
		},
		methods: {
			handleCert() {
				this.upload_cert = this.$refs.uploadCert.files[0]
			},
			addCert() {
				Swal.fire({
					title: 'Estas consumiendo 20 coins en esta operación',
					text: '¿Deseas continuar?',
					type: 'info',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {
							let formData = new FormData()
							formData.append('file', this.upload_cert)
							formData.append('title', this.title)

							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}

							axios.post('/profile/add-cert', formData, config)
								.then(res => {
									console.log(res)
									Swal.fire({title: res.data.message, type: 'success', timer: 1500})
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: err.response.data.message, type: 'error', timer: 200})
								})
						}
					})
			},
			deleteCert(cert_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas eliminar este certificado?',
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
						axios.delete(`/profile/delete-cert/${cert_id}`)
							.then(res => {
								console.log(res.data)
								Swal.fire({
									title: res.data.message,
									type: 'success',
									timer: '1500',
								})
							})
							.catch(err => {
								console.log(err.response)
								Swal.fire({
									title: err.response.message,
									type: 'error',
									timer: 2000,
								})
							})
					}
				})
			},
			editCert(cert_id) {
				console.log('Works')
			}
		}
	}
</script>

<style>

</style>
