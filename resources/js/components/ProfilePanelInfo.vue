<template>
	<div id="info-panel" >
		<h3>Información Empresa</h3>
		<div class="panel-alert alert alert-secondary mt-3" role="alert">
			Modifica los datos de tu empresa, además agrega contenido multimedia. <i>¡Ten en cuenta que tu información de contacto será revelada <b>sólo</b> a las empresas que quieran hacer negocios contigo!</i>
		</div>
		<div class="container">

			<!-- Imagen de perfil y portada -->
			<div class="row my-5">
				<div class="col-md-5">
					<p class="h5 text-center text-uppercase">Logotipo <span class="info-icon"><i class="fa fa-info-circle"></i></span></p>
					<figure class="upload-info-img container-profile-img">
						<img :src="profile_img"/>
						<figcaption>
							<a href="#" data-toggle="modal" data-target="#upload-profile-img">
								<div class="upload-info-input">
									<label class="bottom-middle"><i class="fa fa-upload"></i></label>
									<!-- <input id="upload-profile-img" type="file" accept="image/*"> -->
								</div>
							</a>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-7">
					<p class="title-image-cover h5 text-center text-uppercase">Banner <span class="info-icon"><i class="fa fa-info-circle"></i></span></p>
					<figure class="upload-info-img container-cover-img">
						<img :src="cover_img"/>
						<figcaption>
							<a href="#" data-toggle="modal" data-target="#upload-cover-img">
								<div class="upload-info-input">
									<label class="bottom-middle"><i class="fa fa-upload"></i></label>
									<!-- <input id="upload-cover-img" type="file" accept="image/*"> -->
								</div>
							</a>
						</figcaption>
					</figure>
				</div>
			</div>

			<!-- Modals para cambiar foto de perfil y portada -->
			<div class="modal fade" id="upload-profile-img" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Imagen de perfil (Logo)</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Cambia tu imagen de perfil:</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="editProfileImage" lang="es" accept="image/*"
										ref="profileImage"
										@change="handleUserImage(1)"
									>
									<label class="custom-file-label" for="editProfileImage"><i class="fas fa-camera"></i> {{ upload_profile_img_name }}</label>
								</div>
								<small class="text-muted">La imagen tiene que pesar menos de 2 MB</small>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click="editUserImage(1)">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="upload-cover-img" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Imagen de portada (Banner)</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Cambia tu imagen de portada:</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="editCoverImage" lang="es" accept="image/*"
										ref="coverImage"
										@change="handleUserImage(2)"
									>
									<label class="custom-file-label" for="editCoverImage"><i class="fas fa-camera"></i> {{ upload_cover_img_name }}</label>
								</div>
								<small class="text-muted">La imagen tiene que pesar menos de 2 MB</small>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click="editUserImage(2)">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End modals -->

			<!-- Btn copiar link -->
			<div class="text-center">
				<label for="" class="text-uppercase h5">Link de Perfil</label>
			</div>
			<div class="input-group" style="margin-bottom: 30px;">
				<input id="profileLink" type="text" class="form-control" readonly="readonly" :value="profile_link">
				<div class="input-group-append">
					<button class="btn btn-save" type="button" @click="copyLink()">
						Copiar
					</button>
				</div>
			</div>
		</div>
		<!-- Datos -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Datos Empresa</label>
		</div>
		<div class="panel-info-section container">
			<div class="form-group">
				<label for="">Razón Social <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<input type="text" class="form-control" placeholder="Razón Social" v-model="name">
			</div>
			<div class="form-group">
				<label for="">Nombre comercial <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<input type="text" class="form-control" placeholder="Nombre Comercial" v-model="commercial_name">
			</div>

			<div class="form-group">
				<label for="">Categorías</label>
				<div class="btn-group select-category ">
					<button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Seleccione una categoría
					</button>
					<div class="dropdown-menu scrollable-menu" role="menu">
						<a
							class="dropdown-item" href="#"
							v-for="category in categories" :key="category.id"
							@click.prevent.stop="addCategory(category)"
						>
							<img :src="category.picture" height="20" class="mr-2">
							<span class="mr-2">{{ category.name }}</span>
							<span v-if="checkIfIncludes(category.id)" style="color: #88BE2E;">
								<i class="fas fa-check"></i>
							</span>
						</a>
					</div>
				</div>
				<small class="text-muted">
					Seleccione máximo 5 categorias.
				</small>
				<div class="selected-categories mt-3">
					<div class="container row">
						<div class="col-md-3" v-for="user_category in user_categories" :key="user_category.id">
							<div class="p-1">
								<span class="badge badge-success" style="padding: 7px;">
									{{ user_category.name }}
								</span>
								<a href="#" @click.prevent.stop="quitCategory(user_category.id)"><span class="badge badge-danger">x</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="">Descripción <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
				<textarea class="form-control" id="" rows="5" v-model="description"></textarea>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Email <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="email" class="form-control" placeholder="Email" v-model="email" disabled="true">
				</div>
				<div class="form-group col-md-6">
					<label for="">Teléfono <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="text" class="form-control" placeholder="Teléfono" v-model="phone">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">RUC <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="ruc" class="form-control" placeholder="RUC" v-model="ruc" disabled="true">
				</div>
				<div class="form-group col-md-6">
					<label for="">Partida Registral <span class="info-icon"><i class="fa fa-info-circle"></i></span></label>
					<input type="text" class="form-control" placeholder="Partida registral" v-model="legal_registration" disabled="true">
				</div>
			</div>
			<button @click="editUser()" class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">
				Guardar Cambios
			</button>
		</div>

		<!-- Verificacion -->
		<div class="text-center panel-info-subtitle">
			<span class="text-uppercase h5">Validación</span>
		</div>
		<div class="panel-info-section">
			<div v-if="verified !== 2" class="panel-alert alert alert-secondary mt-3" role="alert">
				Si quieres obtener una cuenta verificada, sigue los siguientes pasos:
				<br><br>
				<ol style="margin-left: 15px;">
					<li>Ingresa la ficha RUC(formato PDF) de tu empresa.</li>
					<li>Espera a que te llegue un Código de Verificación a tu dirección fiscal.</li>
					<li>Ingresa el código de Verificación.</li>
					<li>¡Listo! ya tienes una cuenta verificada.</li>
				</ol>
			</div>
			<div v-if="verified === 0">
				<div class="container">
					<p class="h5">¿Como obtener ficha RUC?</p>
					<iframe class="ruc-video" src="https://www.youtube.com/embed/zH66mH2wIN8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<br>
				<div class="container">
					<p class="h5">Ingresa ficha ruc:</p>
					<div class="custom-file">
						<input
							type="file" class="custom-file-input"
							id="rucFile" accept="application/pdf"
							ref="rucFile"
							@change="handleFile()"
						>
						<label class="custom-file-label" for="rucFile"><i class="fas fa-file-pdf"></i> {{ruc_file_name}}</label>
						<small><span class="text-muted">Solamente se aceptará archivos de formato pdf</span></small>
					</div>
				</div>
				<button @click="validatePlan()" class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">
					Enviar Ficha RUC
				</button>
			</div>
			<div v-else-if="verified == 1">
				<div class="container">
					<p class="h5">Ingresa código de verificación:</p>
					<div class="custom-file">
						<input type="text" class="form-control" v-model="verificationCode" maxlength="30">
					</div>
				</div>
				<button @click="validateAccount()" class="btn btn-lg btn-block btn-save" style="margin-top: 25px;">
					Validar
				</button>
			</div>
			<div v-else-if="verified == 2">
				<div class="container my-2">
					<div class="media">
						<img class="align-self-center mr-3" src="\img\notification-icons\success.svg" style="width: 70px;">
						<div class="media-body align-self-center">
							<h3 class="mt-0">Verificado exitosamente</h3>
						</div>
					</div>			
				</div>
				
			</div>
		</div>
		<!-- End -->

		<!-- Imagenes -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Imagenes</label>
		</div>
		<div class="panel-info-section">
			<div class="container">
				<div class="panel-alert alert alert-success" role="alert">
					<p>Dependiendo del tipo de plan que tengas puedes subir cierta cantidad de Imagenes:</p>
					<ul style="margin-left: 15px;">
						<li v-for="plan in plans" :key="plan.id" v-bind:class="{'active-plan': current_plan.id === plan.id}">
							{{ plan.name }}: {{plan.images}} imagenes <span v-if="current_plan.id === plan.id"><i class="fa fa-arrow-left" aria-hidden="true"></i> Tu plan</span>
						</li>
					</ul>
				</div>
			</div>
			<p class="multi-preview-info">
				Puedes agregar: {{ might_add_images.number }} imagen(es)
				<a href="/planes" target="_blank" style="font-family: arial, sans-serif;"><small>Mejora tu plan</small></a>
			</p>
			<!-- Carousel imagenes -->
			<div id="multi-carousel-images">
				<div class="multi-carousel-item" v-for="image in images" :key="image.id">
					<!-- Imagen -->
					<div class="multi-image-container">
						<a :data-target="'#xdasdas'+image.id" data-toggle="modal" href="#">
							<img :src="image.url" class="multi-image">
						</a>
					</div>
				</div>
				<!-- Si es que AUN puede agregar IMAGENES -->
				<div class="multi-carousel-item" v-if="might_add_images.can">
					<div class="multi-add-container">
						<div class="multi-image">
							<a href="#" data-target="#upload-multi-image" data-toggle="modal">
								<label class="multi-add-text">
									<p><i class="fa fa-plus" aria-hidden="true"></i></p>
									<p>Agregar Imagen</p>
								</label>
							</a>
						</div>
					</div>
				</div>
				<!-- Si es que NO puede agregar -->
				<div class="multi-carousel-item" v-if="might_add_images.can == false && might_add_images.limit == false">
					<div class="multi-locked-upload">
						<div style="margin-top: 10%;">
							<span style="margin-bottom: 5px;">
								<i style="font-size: 50px;" class="fas fa-lock"></i>
							</span>
							<p>
								<span style="font-size: 20px;">No puedes agregar</span>
								<br>
								<a href="/planes" target="_blank"><small style="font-family: arial, sans-serif;">Mejorar plan</small></a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- Modals -->
			<div v-for="image in images" :key="image.id" class="modal fade" :id="'xdasdas'+image.id" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-body mb-0 p-0">
							<img :src="image.url" style="width: 100%;">
						</div>
						<div class="modal-footer p-0">
							<button class="btn btn-danger btn-block" @click="deleteImage(image.id)">
								Eliminar
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal add image -->
			<div class="modal fade" id="upload-multi-image" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Agregar Imagen</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Puedes agregar: <b style="color: #88BE2E;">{{ might_add_images.number }} imagen(es)</b>:</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="accountImage" lang="es" accept="image/*"
										ref="accountImage"
										@change="handleAccountImage()"
									>
									<label class="custom-file-label" for="accountImage"><i class="fas fa-camera"></i> {{ account_img_name }}</label>
								</div>
							</div>
							<small class="text-muted">La imagen tiene que pesar menos de 2 MB</small>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click.prevent.stop="addImage()">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Videos -->
		<div class="text-center panel-info-subtitle">
			<label for="" class="text-uppercase h5">Videos</label>
		</div>
		<div class="panel-info-section">
			<div class="container">
				<div class="panel-alert alert alert-success" role="alert">
					<p>Dependiendo del tipo de plan que tengas puedes subir cierta cantidad de videos:</p>
					<ul style="margin-left: 15px;">
						<li v-for="plan in plans" :key="plan.id" v-bind:class="{'active-plan': current_plan.id === plan.id}">
							{{ plan.name }}: {{plan.videos}} videos <span v-if="current_plan.id === plan.id"><i class="fa fa-arrow-left" aria-hidden="true"></i> Tu plan</span>
						</li>
					</ul>
				</div>
			</div>
			<!-- Carousel videos -->
			<p class="multi-preview-info">
				Puedes agregar: {{ might_add_videos.number }} video(s)
				<a href="/planes" target="_blank" style="font-family: arial, sans-serif;"><small>Mejora tu plan</small></a>
			</p>
			<div id="multi-carousel-videos">
				<div class="multi-carousel-item" v-for="video in videos" :key="video.id">
					<div class="multi-image-container">
						<a :data-target="'#sdasdas'+video.id" data-toggle="modal" href="#">
							<video :src="video.url" class="multi-image"></video>
						</a>
					</div>
				</div>
				<!-- Si es que AUN puede agregar VIDEOS -->
				<div class="multi-carousel-item" v-if="might_add_videos.can">
					<div class="multi-add-container">
						<div class="multi-image">
							<a href="#" data-toggle="modal" data-target="#upload-multi-video">
								<label class="multi-add-text">
									<p><i class="fa fa-plus" aria-hidden="true"></i></p>
									<p>Agregar Video</p>
								</label>
							</a>
						</div>
					</div>
				</div>
				<!-- Si es que NO puede agregar -->
				<div class="multi-carousel-item" v-if="might_add_videos.can == false && might_add_videos.limit == false">
					<div class="multi-locked-upload">
						<div style="margin-top: 10%;">
							<span style="margin-bottom: 5px;">
								<i style="font-size: 50px;" class="fas fa-lock"></i>
							</span>
							<p>
								<span style="font-size: 20px;">No puedes agregar</span>
								<br>
								<a href="/plans" target="_blank"><small style="font-family: arial, sans-serif;">Mejorar plan</small></a>
							</p>
						</div>
					</div>
				</div>
			</div>

			<!-- Modals -->
			<div v-for="video in videos" :key="video.id" class="modal fade" :id="'sdasdas'+video.id" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-body mb-0 p-0">
							<video controls style="width: 100%">
								<source :src="video.url">
							</video>
						</div>
						<div class="modal-footer p-0">
							<button class="btn btn-danger btn-block" @click="deleteVideo(video.id)">
								Eliminar
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal add video -->
			<div class="modal fade" id="upload-multi-video" role="dialog" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Agregar Video</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Puedes agregar: <b style="color: #88BE2E;">{{ might_add_videos.number }} videos(s)</b>:</label>
								<div class="custom-file">
									<input
										type="file" class="custom-file-input"
										id="editOfferImage" lang="es" accept="video/mp4"
										ref="accountVideo"
										@change="handleAccountVideo()"
									>
									<label class="custom-file-label" for="editOfferImage"><i class="fas fa-video"></i> {{account_video_name}}</label>
								</div>
							</div>
							<small class="text-muted">La video debe pesar menos de 30 MB</small>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-add" @click.prevent.stop="addVideo()">Agregar</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'user',
			'media_data',
			'current_plan',
			'categories_data'
		],
		data() {
			return {
				name: '',
				commercial_name: '',
				phone: '',
				ruc: '',
				legal_registration: '',
				email: '',
				description: '',
				profile_img: '',
				cover_img: '',
				verified: '',
				images: [],
				videos: [],
				plans: [],
				categories: [],
				user_categories: [],
				//
				upload_profile_img: [],
				upload_cover_img: [],
				account_img: [],
				account_video: [],
				ruc_file: [],
				//
				upload_profile_img_name: '',
				upload_cover_img_name: '',
				account_img_name: '',
				account_video_name: '',
				ruc_file_name: '',
				//
				verificationCode: '',
			}
		},
		created() {
			this.name = this.user.name
			this.commercial_name = this.user.commercial_name
			this.phone = this.user.phone
			this.ruc = this.user.ruc
			this.legal_registration = this.user.legal_registration
			this.email = this.user.email
			this.description = this.user.description
			this.profile_img = this.user.profile_img
			this.cover_img = this.user.cover_img
			this.images = this.media_data.images
			this.videos = this.media_data.videos
			this.user_categories = this.categories_data
			this.verified = this.user.verified

			//
			this.upload_profile_img_name = 'Seleccione una imagen'
			this.upload_cover_img_name = 'Seleccione una imagen'
			this.account_img_name = 'Seleccione una imagen'
			this.account_video_name = 'Seleccione un video(.mp4)'
			this.ruc_file_name = 'Selecciona un archivo(.pdf)'

			axios.get('/api/categories')
					.then(res => {
						this.categories = res.data
					});

			axios.get('/api/plans')
					.then(res => {
						this.plans = res.data
					})
		},
		mounted() {
			const multi_carousel_images = Tiny.tns({
				container: '#multi-carousel-images',
				autoplay: true,
                mouseDrag: true,
                controls: false,
                nav: false,
                autoplayButtonOutput: false,
				items: 1,
				slideBy: 1,
				responsive: {
					768: {
						items: 2
					},
					1100: {
						items: 3
					}
				}
			});

			const multi_carousel_videos = Tiny.tns({
				container: '#multi-carousel-videos',
				autoplay: true,
                mouseDrag: true,
                controls: false,
                nav: false,
                autoplayButtonOutput: false,
				items: 1,
				slideBy: 1,
				responsive: {
					768: {
						items: 2
					},
					1100: {
						items: 3
					}
				}
			});
		},
		computed: {
			profile_link() {
				return window.location.origin + '/business/profile/' + this.user.slug
			},
			might_add_images() {
				const number = this.current_plan.images - this.images.length

				return {
					'number': number,
					'can': number > 0,
					'limit': !!this.current_plan.is_best,
				}
			},
			might_add_videos() {
				const number = this.current_plan.videos - this.videos.length

				return  {
					'number': number,
					'can': number > 0,
					'limit': !!this.current_plan.is_best,
				}
			}
		},
		methods: {
			reloadSection() {
				this.$parent.activePanel(1);
			},
			copyLink() {
				const copiedLink = document.querySelector('#profileLink');
				copiedLink.select();
				copiedLink.setSelectionRange(0, 99999);
				document.execCommand('copy');

				Swal.fire({
					position: 'top-end',
					type: 'success',
					title: 'Link copiado',
					showConfirmButton: false,
					timer: 1500
				})
			},
			checkIfIncludes(category_id) {
				if(this.user_categories.some(e => e.id == category_id)) {
					return true
				} else {
					return false
				}
			},
			addCategory(category) {
				if (this.user_categories.length < 5) {
					if (!this.checkIfIncludes(category.id) === true) {
						this.user_categories.push(category)

						Swal.fire({
							position: 'top-end',
							type: 'success',
							title: 'Categoría agregada',
							showConfirmButton: false,
							timer: 1500
						})
					} else {
						Swal.fire({
							position: 'top-end',
							type: 'info',
							title: 'La categoría ya fue agregada',
							showConfirmButton: false,
							timer: 1500
						})
					}
				} else {
					Swal.fire({
						position: 'top-end',
						type: 'info',
						title: 'Sólo puedes agregar 5 categorias como máximo',
						showConfirmButton: false,
						timer: 1500
					})
				}

			},
			quitCategory(category_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas remover esta categoría?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value === true) {
							this.user_categories.forEach((element, index) => {
								if (element.id === category_id) {
									this.user_categories.splice(index, 1)
								}
							});
						}
					})
			},
			editUser() {
				Swal.fire({
					title: '¿Estas seguro que deseas modificar tus datos?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value === true) {
							axios.put(`/profile/user`, {
								name: this.name,
								commercial_name: this.commercial_name,
								description: this.description,
								email: this.email,
								phone: this.phone,
								user_categories: this.user_categories,
							})
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, timer: 1500})

								})
								.catch(err => {
									console.log(err);
									Swal.fire({title: err.data.message, type: err.data.status, timer: 1500})
								})
						}
					})
			},
			handleUserImage(type) {
				switch (type) {
					case 1:
						this.upload_profile_img = this.$refs.profileImage.files[0]
						this.upload_profile_img_name = this.upload_profile_img.name
						break;
					case 2:
						this.upload_cover_img = this.$refs.coverImage.files[0]
						this.upload_cover_img_name = this.upload_cover_img.name
						break;
					default:
						console.log('Error. No exists that type: ',type);
						break;
				}
			},
			editUserImage(type) {
				Swal.fire({
					title: '¿Estas seguro que deseas modificar esta imagen?',
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

							if  (type == 1) {
								formData.append('image', this.upload_profile_img);
							} else if (type == 2) {
								formData.append('image', this.upload_cover_img);
							}

							// Comprobar el contenido del formData
							for (let key of formData.entries()) {
								console.log(key[0] + ', ' + key[1]);
							}

							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}

							axios.post(`/profile/upload-user-image/${type}`, formData, config)
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, timer: 1500})
										.then(res => location.reload())
								})
								.catch(err => {
									Swal.fire({title: err.response.data.message, type: err.response.data.status, timer: 1500})
								})
						}
					})
			},
			handleAccountImage() {
				this.account_img = this.$refs.accountImage.files[0]
				this.account_img_name = this.account_img.name
			},
			addImage() {
				Swal.fire({
					title: `¿Deseas agregar esta imagen?: `,
					text: `${this.account_img.name}`,
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {

							let formData = new FormData();
							formData.append('image', this.account_img)

							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}

							axios.post('/profile/add-account-image', formData, config)
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, timer: 1500})
										.then(res => location.reload())
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: 'Error al subir la imagen', type: 'error', timer: 1500})
								})
						}
					})
			},
			deleteImage(image_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas eliminar esta imagen?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {
							axios.delete(`/profile/delete-account-image/${image_id}`)
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, showConfirmButton: false, timer:1500})
										.then(res => {
											// Cierra el modal
											$('#xdasdas'+image_id).modal('hide')
											// Quita el elemento del array de imagenes
											this.images.forEach((element, index) => {
												if (element.id === image_id) {
													this.images.splice(index, 1)
												}
											});
										})
								})
								.catch(err => {
									Swal.fire({title: 'Error al borrar imagen', type: err.response.data.status})
								})
						}
					})
			},
			handleAccountVideo() {
				this.account_video = this.$refs.accountVideo.files[0]
				this.account_video_name = this.account_video.name
			},
			addVideo() {
				Swal.fire({
					title: `¿Deseas agregar este video?: `,
					text: `${this.account_video.name}`,
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value === true) {

							let formData = new FormData();
							formData.append('video', this.account_video);

							const config = {
								headers: {'content-type': 'multipart/form-data'}
							}

							Swal.fire({
								title: 'Guardando',
								onBeforeOpen: () => {
									Swal.showLoading();
								}
							})

							axios.post('/profile/add-account-video', formData, config)
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, timer: 1500})
										.then(res => location.reload())
								})
								.catch(err => {
									Swal.fire({title: 'Error al subir el video', type: 'error', timer: 1500})
								})
						}
					})
			},
			deleteVideo(video_id) {
				Swal.fire({
					title: '¿Estas seguro que deseas eliminar este video?',
					type: 'warning',
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'Cancelar',
					showCancelButton: true,
				})
					.then(res => {
						if (res.value == true) {

							Swal.fire({
								title: 'Borrando',
								onBeforeOpen: () => {
									Swal.showLoading();
								}
							})

							axios.delete(`/profile/delete-account-video/${video_id}`)
								.then(res => {
									Swal.fire({title: res.data.message, type: res.data.status, timer:1500, showConfirmButton: false})
										.then(res => {
											// Cierra el modal
											$('#sdasdas'+video_id).modal('hide')
											// Quita el elemento del array de imagenes
											this.videos.forEach((element, index) => {
												if (element.id === video_id) {
													this.videos.splice(index, 1)
												}
											});
										})
								})
								.catch(err => {
									console.log(err.response)
									Swal.fire({title: 'Error al borrar video', type: 'error'})
								})
						}
					})
			},
			handleFile() {
				this.ruc_file = this.$refs.rucFile.files[0]
				this.ruc_file_name = this.ruc_file.name
			},
			validatePlan() {
				let operation = this.$parent.operations[4]; // Solicitat verificacion

				switch (this.$parent.current_plan.slug) {
					case 'premium':	
						this.sendRucFile();
						break;

					case 'standard':
						Swal.fire({
							title: `Estas consumiendo ${operation.coins_cost} coins en esta operación`,
							text: '¿Deseas continuar?',
							type: 'info',
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Si',
							cancelButtonText: 'Cancelar',
							showCancelButton: true,
						})
							.then(res => {
								this.sendRucFile();
							})

						break;

					case 'free':
						Swal.fire({
							title: 'No puede realizar esta operación',
							text: 'Es necesario el Plan Standard o Premium para poder verificar tu cuenta',
							type: 'error',
							timer: 2000,
						})
						break;
				}
			},
			sendRucFile() {
				let formData = new FormData();
				formData.append('file', this.ruc_file);

				const config = {
					headers: {'content-type': 'multipart/form-data'}
				}

				Swal.fire({
						title: 'Enviando',
						onBeforeOpen: () => {
							Swal.showLoading();
						}
					})

				axios.post('/validacion/process-ruc-file', formData, config)
					.then(res => {
						console.log(res.data);
						this.resultAlert(res.data);
					})
					.catch(err => {
						console.log(err.response.data);
						this.resultAlert(err.response.data);
					})
			},
            validateAccount() {
			    Swal.fire({
			    	title: 'Verificando código',
			    	onBeforeOpen: () => {
			    		Swal.showLoading();
			    	}
			    })

			    axios.post('/validacion/validate-account', {
			    	code: this.verificationCode
			    })
			    	.then(res => {
			    		console.log(res.data);
			    		this.resultAlert(res.data);
			    	})
			    	.catch(err => {
			    		console.log(err.response.data);
			    		this.resultAlert(err.response.data);
			    	})
			},
			resultAlert(data){
				Swal.fire({
	    			title: data.message,
	    			text: data.text,
	    			type: data.status,
	    		})
	    			.then(res => {
	    				if (data.status === 'success') {
	    					location.reload();
	    				} else {
	    					console.log('ok');
	    				}
	    			})
			}
		}
	}
</script>

<style>
.select-category {
	width: 100%;
}

.select-category .btn {
	background-color: #FFFFFF;
	border: 1px solid #ced4da;
	text-align: left;
}

.select-category .dropdown-menu {
	width: 100%;
}

.selected-categories {
	padding: 10px;
	background-color: #E9ECEF;
	border: 1px solid #E9ECEF;
	border-radius: 6px;
}

.multi-preview-info {
	font-family: 'Poppins', sans-serif;
	font-size: 20px;
}

.no-image__container {
	margin-top: 20px;
	margin-bottom: 25px;
}

.no-image {
	width: 200px;
	height: 150px;
}

.preview-image {
	width: 70%;
	height: auto;
	border-radius: 6px;
}

.preview-image__container {
	margin-top: 15px;
	margin-bottom: 15px;
}

.btn-delete-multi {
	float: right;
}

.active-plan {
	font-weight: bold;
}

.multi-carousel-item {
	padding: 10px;
}

.upload-info-img {
	position: relative;
	overflow: hidden;
	margin: 10px 0;
	text-align: center;
	border-radius: 8px;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}

.upload-info-img * {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	-webkit-transition: all 0.6s ease;
	transition: all 0.6s ease;
}

.upload-info-img img {
	opacity: 1;
	display: block;
	height: 250px;
	position: relative;
}

.upload-info-img figcaption {
	top: 25%;
	left: 0;
	right: 0;
	bottom: 0;
	margin: 10px 12px 5px;
	position: absolute;
}

.upload-info-img h4, .upload-info-img i {
	color: rgba(0, 0, 0, 0.7);
}

.upload-info-img i {
	font-size: 100px;
}

.upload-info-img a {
	text-decoration: none;
}

.upload-info-img .bottom-middle, .upload-info-img .bottom-right {
	bottom: 40%;
	opacity: 0;
}
.upload-info-img .bottom-middle {
	-webkit-transform: translate(0%, 50%);
	transform: translate(0%, 50%);
}

.upload-info-img:hover img, .upload-info-img.hover img {
	opacity: 0.6;
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}
.upload-info-img:hover figcaption .bottom-middle, .upload-info-img.hover figcaption .bottom-middle,
.upload-info-img:hover figcaption .bottom-right, .upload-info-img.hover figcaption .bottom-right {
	-webkit-transform: translate(0, 0);
	transform: translate(0, 0);
	opacity: 1;
}

.upload-info-input > input {
	display: none;
}

.upload-info-input > label {
	cursor: pointer;
}

.container-profile-img img {
	width: 85%;
	margin: auto;
}

.container-cover-img img {
	width: 100%;
}

/* Form styles */

.btn-save {
	background-image: linear-gradient(to right, #56ab2f 0%, #a8e063 51%, #56ab2f 100%);
	transition: 0.5s;
	background-size: 200% auto;
	font-family: 'Roboto',sans-serif;
	color:rgb(231, 255, 255);
}

.btn-save:hover {
	background-position: right center;
	color:rgb(231, 255, 255);
}

.info-icon {
	color: rgb(93, 151, 240);
	cursor: pointer;
}

.info-icon:hover {
	color: rgb(81, 126, 194);
	transition: all ease 500ms;
}

.panel-info-section {
	border: solid 1px #e6e6e6;
	border-radius: 15px;
	padding: 25px;
	margin-bottom: 35px;
}

.panel-info-subtitle {
	margin-bottom: 15px;
}

.panel-info-subtitle label {
	margin: 0;
}

.multi-image-container {
	position: relative;
	overflow: hidden;
	margin: 10px 0;
	text-align: center;
	border-radius: 8px;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
	background-color: #000;
	cursor: pointer;
	height: 150px;
}

.multi-add-container {
	position: relative;
	overflow: hidden;
	margin: 10px 0;
	text-align: center;
	border-radius: 8px;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
	height: 150px;
}

.multi-image {
	opacity: 1;
	display: block;
	height: 100%;
	position: relative;
	width: 100%;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	-webkit-transition: all 0.6s ease;
	transition: all 0.6s ease;
}

.multi-add-text {
	margin-top: 20%;
	cursor: pointer;
}

.multi-add-text p {
	margin-bottom: 0px;
	font-size: 20px;
	color: #D87B4B;
}

.multi-image:hover{
	opacity: 0.6;
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}

.multi-locked-upload {
	height: 150px;
	background-color: #E2E3E5;
	border: 1px solid #d6d8db;
	color: #383d41;
	background-color: #e2e3e5;
	border-radius: 0.25rem;
	margin: 10px;
	text-align: center;
}

.ruc-video {
	width: 100%;
	height: auto;
}

@media screen and (max-width: 768px) {
	.container-profile-img img, .container-cover-img img  {
		height: 170px;
	}

	/*
	.multi-image-container {
		height: 100px;
	}*/
}

@media screen and (max-width: 600px) {
	.container-profile-img {
		width: 80%;
		margin: auto;
	}
	.container-profile-img img {
		height: 150px;
	}
	.container-cover-img img {
		height: 150px;
	}
	.title-image-cover {
		margin-top: 25px;
	}
	.multi-image-container {
		height: 150px;
	}

	.multi-preview-info {
		font-size: 13px;
	}
}

@media screen and (max-width: 600px) and (orientation: landscape) {
	.container-profile-img {
		width: 50%;
		height: 170px;
		margin: auto;
	}

	.container-cover-img {
		width: 70%;
		margin: auto;
	}

	.multi-image-container, .multi-add-container, .multi-locked-upload {
		width: 50%;
		margin: auto;
	}
}
</style>
