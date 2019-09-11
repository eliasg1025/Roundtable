<template>
	<section class="businessProduct">
		<div class="container">
			<h2 class="title-businessProducts">Ofertas</h2>
			<div id="carousel-business-products">
				<!-- Card -->
				<div class="container" v-for="(data_offer, index) in data_offers" :key="index">
					<div class="card">
						<img :src="data_offer.offer.image_url" class="product-image card-img-top">
						<div class="card-body">
							<h5 class="card-title product-title">
								{{ data_offer.offer.title }}
							</h5>
							<p class="product-category">
								Categoria: <span class="badge">{{ data_offer.offer_category[0].name }}</span>
							</p>
							<button class="btn btn-outline-success" data-toggle="modal" data-target="#modalProductDetail-1">
								Ver detalle
							</button>
						</div>
					</div>
				</div>
				<!-- End Card -->
			</div> 
			<!-- Controls -->
			<div id="carousel-business-products-controls" class="text-center">
				<span class="thumbnail-item" style="margin-right: 5px;">
					<a class="btn btn-control">
						<img src="/img/angle-left.png" alt="">
						<span style="color: #6d6d6d">Anterior</span>
					</a>
				</span>
				<span class="thumbnail-item" style="margin-left: 5px;">
					<a class="btn btn-control">
						<span style="color: #6d6d6d">Siguiente</span>
						<img src="/img/angle-right.png" alt="">
					</a>
				</span>
			</div>
			<!-- End Controls -->
		</div>
		<div class="modal fade" id="modalProductDetail-1" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalProductDetail-1">Producto 1</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-5">
								<img src="/img/fondo/fondo_login.jpg" class="card-img-top">
							</div>
							<div class="col-md-7">
								<ul>
									<li>Certificado 1</li>
									<li>Certificado 2</li>
									<li>Certificado 3</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		name: 'business-products',
		props: ['data_offers'],
		data() {
			return {
				modal_content: {},
			}
		},
		mounted() {
			const slider_business_products = Tiny.tns({
				container: '#carousel-business-products',
				items: 4,
				controlsContainer: '#carousel-business-products-controls',
				nav: false,
				mouseDrag: true,
			});
		}
	}
</script>

<style>
	.businessProduct {
		padding: 80px 0px 0px 0px;
		position: relative;
		background-color: rgb(230, 230, 230);
	}

	#carousel-business-products-controls {
		margin-top: 25px;
	}

	.title-businessProducts {
		font-family: 'Roboto', sans-serif;
		margin-left: 17px;
		margin-bottom: 25px;
	}

	.product-image {
		height: 140px;
	}

	.product-title {
		font-family: 'Roboto', sans-serif;
	}

	.product-category .badge{
		background-color: #88BE2E;
	}

	.btn-detalle {
		background-color: #88BE2E;
	}
</style>
