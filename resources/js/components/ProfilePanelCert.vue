<template>
	<div id="cert-panel" class="container">
		<h3>Certificaciones</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Añade las certificaciones o acreditaciones de tu empresa. Dependiendo de tu plan puedes añadir cierta cantidad de certificaciones en formato pdf.
			<br>
			<i>Subir <b>una certificación</b> te cuesta <a href="/planes" target="_blank"><b>20 coins</b></a></i>.
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
									<button class="btn btn-secondary btn-block" @click="editCert(cert.id)">Editar</button>
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
	</div>
</template>

<script>
	export default {
		props: [
			'certifications',
		],
		methods: {
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
						console.log('true')
					}
					axios.delete('api/user_certifications', {
						'user_certification_id': cert_id,
						'user_id': this.user.id
					})
						.then(res => {
							if (res.data == 'OK') {
								Swal.fire({
									title: 'Certificado borrado con exito',
									type: 'success',
									timer: '1500',
								})
									.then(res => {

									})
							}
						})
						.catch(err => {
							Swal.fire({
								title: 'Hubo un error al borrar el certificado',
								type: 'error',
								timer: 2000,
							})
						})
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
