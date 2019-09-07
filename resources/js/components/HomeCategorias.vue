<template>
    <section class="seccion_categorias">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="titulo_categorias text-uppercase">Categorias</h3>
                    </div>
                </div>
                <div class="col-lg-12">
					
					<div id="carousel_categorias1">
						<div v-for="(categoria, index) in grupo_categorias.first" :key="index">
							<div class="box_categorias">
								<div class="item">
									<a href="#">
										<img :src="categoria.picture" alt="">
										<h6>{{categoria.name}}</h6>
									</a>
								</div>	
							</div>
						</div>
					</div>

					<div id="carousel_categorias2">
						<div v-for="(categoria, index) in grupo_categorias.second" :key="index">
							<div class="box_categorias">
								<div class="item">
									<a href="#">
										<img :src="categoria.picture" alt="">
										<h6>{{categoria.name}}</h6>
									</a>
								</div>	
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
	props: ['data'],
	data() {
		return {
			grupo_categorias: {
				first: [],
				second: []
			},
		}
	},
	created() {
		let first = [];
		let second = [];

		this.data.forEach((element, index) => {
			if (index % 2 === 0) {
				first.push(element)
			} else {
				second.push(element)
			}
		});

		this.grupo_categorias.first = first;
		this.grupo_categorias.second = second;
	}
}
</script>

<style>
    .seccion_categorias {
        background-image: url('/img/fondo/fondo_cate.jpg');
        background-size: cover;
        padding: 60px 0;
        position: relative;
        background-position: center;
        background-attachment: fixed;
    }
	.seccion_categorias:before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #000;
		opacity: .3;
	}
    .titulo_categorias {
        color: #f4f4f4;
		margin-bottom: 40px;
    }
	.box_categorias {
		display: flex;
		flex-flow: row wrap;
	}
	.box_categorias .item {
		width: 90%;
		margin: 0 auto;
		margin-bottom: 25px;
	}
	.box_categorias .item a {
		display: block;
		padding: 20px;
		background: #f1f1f1;
		border-radius: 15px;
		box-shadow: 0px 0px 5px 2px #797979;
		text-decoration: none;
	}
	.box_categorias .item a img {
		width: 100%;
		max-width: 200px;
		margin: 0 auto;
		display: block;
	}
	.box_categorias .item a h6 {
		color: #000;
		display: block;
		text-align: center;
		font-size: 17px;
		margin-top: 10px;
	}
</style>
