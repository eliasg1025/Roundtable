<template>
	<section class="businessProduct" id="businessProductSection">
		<div class="container">
			<h2 class="title-businessProducts">Ofertas</h2>
			<div v-if="data_offers.length > 0">
				<div id="carousel-business-products">
					<!-- Carousel Card -->
					<div
						class="card-container container"
						v-for="(data_offer, index) in data_offers"
						:key="index"
					>
						<div class="card" style="height: 100%;">
							<img
								:src="data_offer.offer.image_url"
								class="product-image card-img-top"
							/>
							<div class="card-body">
								<h5 class="card-title product-title">
									{{ data_offer.offer.title }}
								</h5>
								<p class="product-category">
									Categoria:
									<span class="badge">{{
										data_offer.offer_category[0].name
									}}</span>
								</p>
								<button
									class="btn btn-outline-success"
									data-toggle="modal"
									:data-target="
										'#modalProductDetail-' + index
									"
								>
									Ver detalle
								</button>
							</div>
						</div>
					</div>
					<!-- End Card -->
				</div>
				<!-- Controls -->
				<div
					id="carousel-business-products-controls"
					class="text-center"
				>
					<span class="thumbnail-item" style="margin-right: 5px;">
						<a class="btn btn-control">
							<img src="/img/angle-left.png" alt="" />
							<span style="color: #6d6d6d">Anterior</span>
						</a>
					</span>
					<span class="thumbnail-item" style="margin-left: 5px;">
						<a class="btn btn-control">
							<span style="color: #6d6d6d">Siguiente</span>
							<img src="/img/angle-right.png" alt="" />
						</a>
					</span>
				</div>
				<!-- End Controls -->

				<!-- Product Detail Modal -->
				<div v-for="(data_offer, index) in data_offers" :key="index">
					<div
						class="modal fade"
						:id="'modalProductDetail-' + index"
						tabindex="-1"
						role="dialog"
						aria-hidden="true"
					>
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5
										class="product-detail-title modal-title"
									>
										{{ data_offer.offer.title }}
									</h5>
									<button
										type="button"
										class="close"
										data-dismiss="modal"
										aria-label="Close"
									>
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6">
											<a
												:href="
													data_offer.offer.image_url
												"
												target="_blank"
											>
												<img
													:src="
														data_offer.offer
															.image_url
													"
													class="product-detail-image card-img-top"
												/>
											</a>
										</div>
										<div class="col-md-6">
											<div class="content-product-detail">
												<div
													style="margin: 16px 0px 16px;"
												>
													Categoría:
													<button
														class="btn btn-light"
														style="border: 1px solid #cecece;"
													>
														<img
															:src="
																data_offer
																	.offer_category[0]
																	.picture
															"
															class="img-fluid"
															style="height: 40px;"
														/>
														<span
															style="margin: auto;"
															>{{
																data_offer
																	.offer_category[0]
																	.name
															}}</span
														>
													</button>
												</div>
												<div
													class="product-detail-certifications-list"
													style="margin: 5px 0px 16px;"
												>
													Certificaciones:
													<div
														v-if="
															data_offer
																.certifications
																.length > 0
														"
													>
														<ul
															class="nav justify-content-center"
														>
															<li
																v-for="(certification,
																index) in data_offer.certifications"
																:key="index"
																class="nav-item"
																style="padding: 5px;"
															>
																<a
																	:href="
																		certification.url
																	"
																	class="btn btn-light btn-block"
																	target="_blank"
																	style="height: 100%; border: 1px solid #cecece;"
																>
																	<i
																		class="fas fa-file-pdf"
																		aria-hidden="true"
																		style="color: #D54841; font-size: 25px;"
																	></i>
																	<span
																		class="product-certification-title"
																		>{{
																			certification.title
																		}}</span
																	>
																</a>
															</li>
														</ul>
													</div>
													<div v-else>
														<div
															style="color: rgb(147, 147, 147); margin: 10px 0px 10px;"
															class="text-center"
														>
															No hay
															certificaciones
															disponibles
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->
			</div>
			<div v-else>
				<div class="container p-5 text-center">
					<p
						class="h3"
						style="color: rgb(107, 107, 107); margin-bottom: 20px;"
					>
						Aun no hay ofertas disponibles
					</p>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	name: "business-products",
	props: ["data_offers"],
	mounted() {
		if (document.querySelector("#carousel-business-products") !== null) {
			const slider_business_products = Tiny.tns({
				container: "#carousel-business-products",
				controlsContainer: "#carousel-business-products-controls",
				nav: false,
				mouseDrag: true,
				items: 1,
				responsive: {
					640: {
						items: 2
					},
					768: {
						items: 3
					},
					1100: {
						items: 4
					}
				}
			});
		}
	}
};
</script>

<style>
.businessProduct {
	padding: 80px 0px 20px 0px;
	position: relative;
	background-color: rgb(230, 230, 230);
}

#carousel-business-products-controls {
	margin-top: 25px;
}

.title-businessProducts {
	font-family: "Roboto", sans-serif;
	margin-left: 17px;
	margin-bottom: 25px;
}

.product-image {
	height: 140px;
}

.product-title {
	font-family: "Roboto", sans-serif;
}

.product-category .badge {
	background-color: #88be2e;
}

.btn-detalle {
	background-color: #88be2e;
}

.product-detail-title {
	font-family: "Roboto", sans-serif;
}

.product-detail-image {
	border: 1px solid #ddd;
	border-radius: 4px;
	padding: 5px;
	height: 250px;
	object-fit: cover;
}

.product-detail-image:hover {
	box-shadow: 0 0 2px 1px rgb(136, 190, 46);
}

.content-product-detail {
	font-family: "Robot", sans-serif;
}

.product-detail-certifications-list .nav {
	margin-top: 25px;
}

.product-detail-certifications-list .nav-item {
	width: 33%;
	text-align: center;
}

.product-certification-title {
	font-size: 14px;
	margin-top: 10px;
	display: block;
}

@media (max-width: 640px) {
	.product-image {
		height: 200px;
		object-fit: cover;
	}

	.product-detail-image {
		height: 180px;
	}

	.product-certification-title {
		font-size: 12px;
	}
}

.card-container {
	height: 325px;
}

@media (max-width: 640px) {
	.card-container {
		height: 360px;
	}
}
</style>
