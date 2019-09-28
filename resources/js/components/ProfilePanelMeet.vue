<template>
	<div id="meet-panel" class="container">
		<h3>Agendamientos</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Gestiona tus agendamientos. Aquí podrás ver a las empresa que estan interesadas en tus productos y desean contactarse contigo.
			<br>
			<i><b>Solicitar un agendamiento</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a>. Y <b>aceptar un agendamiento</b> te cuesta <a href="/planes" target="_blank"><b>10 coins</b></a>.</i>
		</div>
		<div class="container">
			<div class="text-center panel-info-subtitle mt-4">
				<label for="" class="text-uppercase h5">Datos para el agendamiento</label>
			</div>
			<div class="container">
				<div class="form-group">
					<label for=""><img src="/img/iconos/hangout_logo.png" height="17"> Hangouts</label>
					<input type="text" class="form-control" placeholder="Perfil de Hangouts">
				</div>
				<div class="form-group">
					<label for=""><img src="/img/iconos/skype_logo.png" height="17"> Skype</label>
					<input type="text" class="form-control" placeholder="Perfil de Skype">
				</div>
			</div>


			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>Empresa</th>
							<th>Mensaje</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="mt-5 text-center" v-if="0 === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes agendamientos</p>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

	}
</script>

<style>

</style>
