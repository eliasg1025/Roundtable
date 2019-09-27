<template>
	<div id="cert-panel" class="container">
		<h3>Certificaciones</h3>
		<div class="alert alert-secondary" role="alert">
			Añade las certificaciones o acreditaciones de tu empresa. Dependiendo de tu plan puedes añadir cierta cantidad de certificaciones en formato pdf.
			<br>
			<i>Subir <b>una certificación</b> te cuesta <a href="/planes" target="_blank"><b>20 coins</b></a></i>.
		</div>
		<div class="container">
			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Título</th>
							<th>Certificado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'certificactions',
		]
	}
</script>

<style>

</style>
