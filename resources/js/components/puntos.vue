<template>
	<section class="container e14">
		<div class="col-lg-12">
			<div class="titulo_seccion">
				<h3 class="text-uppercase">paquetes de puntos</h3>
				<h5>Elige el paquete que mas te convenga</h5>
			</div>
		</div>

		<div id="demo" class="ca20 carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
				<li data-target="#demo" data-slide-to="3"></li>
			</ul>

			<!-- The slideshow -->

			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="card">
						<div class="row ">
							<div class="col-md-4">
								<img
									src="/img/tabla-precio/monedi.jpg"
									class="w-100"
								/>
							</div>
							<div class="e15 col-md-5 px-3">
								<div class="card-block px-3">
									<div>
										<h4 class="e16 card-title">
											Paquete de
											{{
												pack_data[0].amount_coins
											}}
											puntos
										</h4>
									</div>
									<div>
										<p class="card-text">
											Duis aute irure dolor in
											reprehenderit in voluptate velit
											esse cillum dolore eu fugiat nulla
											pariatur.
										</p>
									</div>
								</div>
							</div>
							<div class="e15 col-md-3 px-3">
								<div class="c1 card-block">
									<div>
										<h4 class="e16 card-title">
											$ {{ pack_data[0].cost }}
										</h4>
									</div>
									<div>
										<Add-Bag
											:cantidad="
												pack_data[0].amount_coins
											"
											:cost="pack_data[0].cost"
											:slug="pack_data[0].slug"
										></Add-Bag>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- v-for="(pack_data, index) in pack_data" :key="index" -->
				<div class="carousel-item">
					<div class="card">
						<div class="row ">
							<div class="col-md-4">
								<img
									src="/img/tabla-precio/monedi.jpg"
									class="w-100"
								/>
							</div>
							<div class="e15 col-md-5 px-3">
								<div class="card-block px-3">
									<div>
										<h4 class="e16 card-title">
											Paquete de
											{{
												pack_data[1].amount_coins
											}}
											puntos
										</h4>
									</div>
									<div>
										<p class="card-text">
											Duis aute irure dolor in
											reprehenderit in voluptate velit
											esse cillum dolore eu fugiat nulla
											pariatur.
										</p>
									</div>
								</div>
							</div>
							<div class="e15 col-md-3 px-3">
								<div class="c1 card-block">
									<div>
										<h4 class="e16 card-title">
											$ {{ pack_data[1].cost }}
										</h4>
									</div>
									<div>
										<Add-Bag
											:cantidad="
												pack_data[1].amount_coins
											"
											:cost="pack_data[1].cost"
											:slug="pack_data[1].slug"
										></Add-Bag>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-item">
					<div class="card">
						<div class="row ">
							<div class="col-md-4">
								<img
									src="/img/tabla-precio/monedi.jpg"
									class="w-100"
								/>
							</div>
							<div class="e15 col-md-5 px-3">
								<div class="card-block px-3">
									<div>
										<h4 class="e16 card-title">
											Paquete de
											{{
												pack_data[2].amount_coins
											}}
											puntos
										</h4>
									</div>
									<div>
										<p class="card-text">
											Duis aute irure dolor in
											reprehenderit in voluptate velit
											esse cillum dolore eu fugiat nulla
											pariatur.
										</p>
									</div>
								</div>
							</div>
							<div class="e15 col-md-3 px-3">
								<div class="c1 card-block">
									<div>
										<h4 class="e16 card-title">
											$ {{ pack_data[2].cost }}
										</h4>
									</div>
									<div>
										<Add-Bag
											:cantidad="
												pack_data[2].amount_coins
											"
											:cost="pack_data[2].cost"
											:slug="pack_data[2].slug"
										></Add-Bag>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-item">
					<div class="card">
						<div class="row ">
							<div class="col-md-4">
								<img
									src="/img/tabla-precio/monedi.jpg"
									class="w-100"
								/>
							</div>
							<div class="e15 col-md-5 px-3">
								<div class="card-block px-3">
									<div>
										<h4 class="e16 card-title">
											Paquete de
											{{
												pack_data[3].amount_coins
											}}
											puntos
										</h4>
									</div>
									<div>
										<p class="card-text">
											Duis aute irure dolor in
											reprehenderit in voluptate velit
											esse cillum dolore eu fugiat nulla
											pariatur.
										</p>
									</div>
								</div>
							</div>
							<div class="e15 col-md-3 px-3">
								<div class="c1 card-block">
									<div>
										<h4 class="e16 card-title">
											$ {{ pack_data[3].cost }}
										</h4>
									</div>
									<div>
										<Add-Bag
											:cantidad="
												pack_data[3].amount_coins
											"
											:cost="pack_data[3].cost"
											:slug="pack_data[3].slug"
										></Add-Bag>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Left and right controls 
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
             <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>-->
		</div>
	</section>
</template>

<script>
export default {
	name: "puntos",
	props: ["pack_data"],
	mounted() {},
	methods: {
		metodo() {
			window.location = "/planes/pagos";
		}
	}
};
</script>

<style>
.e14 {
	margin-bottom: 50px;
}
.carousel-indicators li {
	background-color: darkgray;
}
.carousel-indicators .active {
	background-color: black;
}
.ca20 {
	box-shadow: 0 8px 12px 0 rgba(15, 15, 15, 0.2);
}

.e15 .card-block {
	margin-top: 35px;
}

.comprar {
	float: right;
}

.e16 {
	font-weight: 500;
	color: #88be2e;
	font-family: "nunito", sans-serif;
	font-size: 26px;
}
.card-text {
	font-family: "Nunito", sans-serif;
}
.c1 {
	text-align: center;
}

.e15 {
	margin: 0px 0px 50px 0px;
}
@media only screen and(max-width: 769px) {
	.ca20 {
		width: 100%;
		margin: 5px 5px 20px 5px;
	}
}
</style>
