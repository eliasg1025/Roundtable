<template>
	<div :id="'lijtgh'+data_offer.offer.id" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Producto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<label for="">
								<img :src="data_offer.offer.image_url" width="100%">
							</label>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Titulo de la oferta:</label>
								<input type="text" class="form-control" placeholder="Titulo" v-model="title">
							</div>
							<div class="form-group">
								<label for="">Cambiar Imagen</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="editOfferImage" lang="es" accept="image/*"
										ref="editOfferImage"
										@change="handleEditOfferImage()"
									>
									<label class="custom-file-label" for="editOfferImage"><i class="fas fa-camera"></i> Seleccione una imagen</label>
								</div>
							</div>
							<div class="form-group">
								<label for="">Categoría:</label>
								<select class="custom-select" v-model="category_id">
									<option
										v-for="category in categories" :key="category.id"
										:selected="category_id == category.id ? 'selected' : false"
										:value="category.id"
									>
										{{ category.name }}
									</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" @click="editProduct()">Guardar cambios</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'data_offer',
			'categories',
		],
		data() {
			return {
				title: '',
				image_url: '',
				category_id: '',
				upload_offer_image: [],
			}
		},
		created() {
			this.title = this.data_offer.offer.title
			this.image_url = this.data_offer.offer.image_url
			this.category_id = this.data_offer.offer.category_id
		},
		methods: {
			handleEditOfferImage() {
				this.upload_offer_image = this.$refs.editOfferImage.files[0]
			},
			editProduct()  {
				Swal.fire({
					title: '¿Realmente deseas editar los datos de este producto?',
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
							formData.append('image', this.upload_offer_image)
							formData.append('title', this.title)
							formData.append('category_id', this.category_id)

							// Comprobar el contenido del formData
							for (var key of formData.entries()) {
								console.log(key[0] + ', ' + key[1]);
							}

							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}

							axios.post(`/profile/edit-product/${this.data_offer.offer.id}`, formData, config)
								.then(res => {
									console.log(res.data)
									Swal.fire({title: res.data.message, type:'success', timer: 1500})
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title:err.response.message, type:'error', timer: 2000})
								})
						}
					})
			}
		}
	}
</script>

<style>

</style>
