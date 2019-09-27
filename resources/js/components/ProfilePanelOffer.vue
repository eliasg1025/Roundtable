<template>
	<div id="offer-panel" class="container">
		<h3>Ofertas</h3>
		<div class="alert alert-secondary" role="alert">
			Añade y cataloga los productos que deseas ofertar. Cada producto puede tener 1 imagen y hasta 3 certificaciones.
			<br>
			<i>Subir <b>una oferta</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a></i>.
		</div>
		<div class="container">
			<div class="table-responsive mt-5">
				<table class="table table-hover">
					<thead>
						<tr style="font-family: 'Roboto', sans-serif;">
							<th>Título</th>
							<th>Imagen</th>
							<th>Certificados</th>
							<th>Categoría</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="data_offer in data_offers" :key="data_offer.offer.id">
							<td class="text-center">
								<p class="table-product__title">
									{{ data_offer.offer.title }}
								</p>
							</td>
							<td>
								<div class="img-cell">
									<a href="">
										<div class="layer"></div>
										<img :src="data_offer.offer.image_url">
									</a>
								</div>
							</td>
							<td>
								<a
									v-for="certification in data_offer.certifications"
									:href="certification.url"
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
				}).then((res) => {
					if (res.value == true) {
						console.log('Borrado')
					}
					axios.delete('api/products', {
						'product_id': product_id
					})
						.then(res => {
							if (res.data == 'OK') {
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
				console.log(product_id)
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
	}

	.img-cell > a > img:hover{
		transform: scale(1.01);
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
