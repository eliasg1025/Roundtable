<template>
	<div id="offer-panel" class="container">
		<h3>Ofertas</h3>
		<div class="panel-alert alert alert-secondary" role="alert">
			Añade y cataloga los productos que deseas ofertar. Cada producto puede tener 1 imagen y hasta 3 certificaciones.
			<br>
			<i>Subir <b>una oferta</b> te cuesta <a href="/planes" target="_blank"><b>30 coins</b></a></i>.
		</div>
		<!-- Btn para agregar productos -->
		<div class="container text-center">
			<button class="btn btn-add" data-toggle="modal" data-target="#modalAddProduct">
				<i class="fas fa-plus"></i> Agregar Producto
			</button>
			<br>
			<small class="mt-1">
				<span class="text-muted">Esta operación cuesta 30 coins. <a href="/planes" target="_blank">Conseguir coins.</a></span>
			</small>
		</div>
		<!-- Tabla de productos -->
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
									:key="certification.id"
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
									<button class="btn btn-primary btn-block" data-toggle="modal" :data-target="'#lijtgh'+data_offer.offer.id">Editar</button>
								</div>
								<div class="container mb-1">
									<button class="btn btn-secondary btn-block" data-toggle="modal" :data-target="'#eeadsas'+data_offer.offer.id">Certificados</button>
								</div>
								<div class="container mb-1">
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

			<!-- Modal Add Product -->
			<div id="modalAddProduct" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Agregar Producto</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Título</label>
								<input type="text" class="form-control" placeholder="Nombre del producto" v-model="title">
							</div>
							<div class="form-group">
								<label for="">Categoría</label>
								<select class="custom-select" v-model="category_id">
									<option
										v-for="category in categories" :key="category.id"
										:value="category.id"
									>
										{{ category.name }}
									</option>
								</select>
							</div>
							<div class="form-group">
								<label for="">Subir Imagen</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="addProductImage" lang="es" accept="image/*"
										ref="offerImage"
										@change="handleOfferImage()"
									>
									<label class="custom-file-label" for="addProductImage"><i class="fas fa-camera"></i> Seleccione una imagen</label>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click="addProduct()">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modals Edit Product -->
			<modal-offer
				v-for="data_offer in data_offers" :key="data_offer.offer.id"
				:data_offer="data_offer"
				:categories="categories"
			></modal-offer>

			<!-- Modals certs -->
			<modal-offer-cert
				v-for="data_offer in data_offers" :key="100-data_offer.offer.id"
				:data_offer="data_offer"
			></modal-offer-cert>
		</div>
	</div>
</template>

<script>
	import ModalOffer from "./ProfileModalOffer";
	import ModalOfferCert from "./ProfileModalOfferCert.vue";

	export default {
		components: {
			ModalOffer,
			ModalOfferCert,
		},
		props: [
			'data_offers'
		],
		data() {
			return {
				categories: [],
				title: '',
				image: {},
				category_id: '',
				upload_offer_image: [],
			}
		},
		created() {
			axios.get('api/categories')
				.then(res => {
					this.categories = res.data
				})
		},
		methods: {
			handleOfferImage() {
				this.upload_offer_image = this.$refs.offerImage.files[0]
			},
			addProduct() {
				Swal.fire({
					title: 'Estas consumiendo 30 coins en esta operación',
					text: '¿Deseas continuar?',
					type: 'info',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						let formData = new FormData()
						formData.append('image', this.upload_offer_image)
						formData.append('title', this.title)
						formData.append('category_id', this.category_id)

						// Comprobar el contenido del formData
						/*for (var key of formData.entries()) {
							console.log(key[0] + ', ' + key[1]);
						}*/

						const config = {
							headers: {'content-type': 'multipart/form-data'}
						}
						if (res.value == true) {
							axios.post('/profile/add-product', formData, config)
								.then(res => {
									console.log(res)
									Swal.fire({title: res.data.message, type: res.data.status, timer: 1500})
										.then(res => location.reload())
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: err.response.data.message, type: 'error', timer: 2000})
								})
						}
					})
			},
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
							axios.delete(`/profile/delete-product/${product_id}`)
								.then(res => {
									console.log(res)
									Swal.fire({
										title: 'Producto borrado con exito',
										type: 'success',
										timer: 1500,
									})
										.then(res => location.reload())
								})
								.catch(err => {
									console.log(err.reponse)
									Swal.fire({
										title: 'Hubo un error al borrar el producto',
										type: 'error',
										timer: 2000,
									})
								})
						}
					})
			},
		}
	}
</script>

<style>
	.btn-add {
		color: #fff;
    	background-color: #88BE2E;
    	border-color: #88BE2E;
    	font-size: 1.1rem;
	}

	.btn-add:hover {
		background-color: #A1DF35;
		color: #fff;
	}

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
		font-size: 13px;
	}

	.btn-cert {
		width: 100%;
		text-align: left;
		margin-bottom: 5px;
		font-size: 13px;
	}

	.table-product__title {
		font-family: 'Roboto', sans-serif;
	}
</style>
