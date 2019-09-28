<template>
	<div id="offer-panel" class="container">
		<h3>Ofertas</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Añade y cataloga los productos que deseas ofertar. Cada producto puede tener 1 imagen y hasta 3 certificaciones.
			<br>
			<i>Subir <b>una oferta</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a></i>.
		</div>
		<div class="container">
			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>Título</th>
							<th>Imagen</th>
							<th>Certificados</th>
							<th>Categoría</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="data_offer in data_offers" :key="data_offer.offer.id">
							<td>
								<p class="table-product__title">
									{{ data_offer.offer.title }}
								</p>
							</td>
							<td>
								<div class="img-cell">
									<a :data-target="'#xasdklj'+data_offer.offer.id" data-toggle="modal" href="#">
										<div class="layer"></div>
										<img :src="data_offer.offer.image_url">
									</a>
								</div>
								<!-- Modal -->
								<div class="modal fade" :id="'xasdklj'+data_offer.offer.id" role="dialog" tabindex="-1" aria-hidden="true" >
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-body mb-0 p-0">
												<img :src="data_offer.offer.image_url" alt="" style="width:100%">
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<a
									v-for="certification in data_offer.certifications"
									:href="certification.url" target="_blank"
									class="btn btn-light btn-cert" style="border: 1px solid #cecece;"
								>
									<span style="margin: auto;">{{ certification.title }}</span>
								</a>
							</td>
							<td>
								<button class="btn btn-light btn-category" style="border: 1px solid #cecece;">
									<img :src="data_offer.offer_category[0].picture" class="img-fluid" style="height: 40px;">
									<br>
									<span style="margin: auto;">{{ data_offer.offer_category[0].name }}</span>
								</button>
							</td>
							<td>
								<div class="container mb-1">
									<button class="btn btn-secondary btn-block" @click="editProduct(data_offer.offer.id)">Editar</button>
								</div>
								<div class="container">
									<button class="btn btn-danger btn-block" @click="deleteProduct(data_offer.offer.id)">Eliminar</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="mt-5 text-center" v-if="data_offers.length === 0">
				<p style="color: #6C757D; font-size: 25px;">Aún no tienes productos ofertados</p>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'data_offers'
		],
		data() {
			return {

			}
		},
		methods: {
			deleteProduct(product_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas eliminar este producto?',
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
							console.log('Borrado')
						}
						axios.delete('api/products', {
							'product_id': product_id,
							'user_id': this.user.id
						})
							.then(res => {
								if (res.data == 'OK') { //
									Swal.fire({
										title: 'Producto borrado con exito',
										type: 'success',
										timer: 1500,
									}).
										then(res => {
											// Recargar componente
										})
								}
							})
							.catch(err => {
								Swal.fire({
									title: 'Hubo un error al borrar el producto',
									type: 'error',
									timer: 2000,
								})
							})
					})
			},
			editProduct(product_id) {
				console.log('Works')
			}
		}
	}
</script>

<style>
	.img-cell {
		width: 200px;
		height: auto;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}

	.img-cell > a > img {
		width: 100%;
		height: 100%;
		border-radius: 10px;
		transition: all ease 500ms;
	}

	.img-cell > a > img:hover{
		transform: scale(1.01);
		transition: all ease 500ms;
	}

	.btn-category {
		width: 100%;
		display: block;
	}

	.btn-cert {
		width: 100%;
		text-align: left;
		margin-bottom: 5px;
	}

	.table-product__title {
		font-family: 'Roboto', sans-serif;
	}
</style>
