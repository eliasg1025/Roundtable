<template>
    <main>
        <home-banner/>
        <home-compradores-destacados :data="this.data.featuredBuyers" :loged="this.data.loged"/>
        <home-vendedores-destacados :data="this.data.featuredSellers" :loged="this.data.loged"/>
        <home-mas-visitados :data="this.data.mostViewedCompanies" :loged="this.data.loged"/>
        
        <!-- Seccion Ofertas -->
        <section class="seccion_ofertas container-fuild px-3 py-4">
            <div class="row">
                <div class="col-lg-6">
                    <img src="/img/publicidad/banner1.jpg" class="oferta-img img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <img src="/img/publicidad/banner3.jpg" class="oferta-img img-fluid" alt="">
                </div>
            </div>
        </section>
        
        <home-categorias :data="this.data.categories"/>
        
        <!-- Carousel insitituciones respaldo-->
        <section class="seccion_respaldo">
            <div class="container">
                <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="text-uppercase">Con el respaldo de</h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="carousel-respaldo" class="imagenes-resplado">
                        <div class="item">
                            <img src="/img/instituciones_respaldo/10d9abd6838a99bb3763ff2fb6a0ea7a.png" alt="" class="img-fluid" style="max-width: 200px; padding-top: 12px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/5bc44a753ef47fb0773a99f5_TOF_Logo_Horizontal_RGB_POS.png" alt="" class="img-fluid" style="max-width: 400px; padding-top: 25px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/fomin-ingles-positivo-cropped.png" alt="" class="img-fluid" style="max-width: 150px; margin-right: 40px; padding-top: 15px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/logogobreg.png" alt="" class="img-fluid" style="max-width: 130px; margin-right: 40px; margin-top: -6px">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/logoudep50-1-1024x272.png" alt="" class="img-fluid" style="max-width: 250px; padding-top: 25px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/fundaciontelefonica.png" alt="" class="img-fluid" style="max-width: 200px; padding-top: 20px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/10d9abd6838a99bb3763ff2fb6a0ea7a.png" alt="" class="img-fluid" style="max-width: 200px; padding-top: 12px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/5bc44a753ef47fb0773a99f5_TOF_Logo_Horizontal_RGB_POS.png" alt="" class="img-fluid" style="max-width: 400px; padding-top: 25px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/fomin-ingles-positivo-cropped.png" alt="" class="img-fluid" style="max-width: 150px; margin-right: 40px; padding-top: 15px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/logogobreg.png" alt="" class="img-fluid" style="max-width: 130px; margin-right: 40px; margin-top: -6px">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/logoudep50-1-1024x272.png" alt="" class="img-fluid" style="max-width: 250px; padding-top: 25px;">
                        </div>
                        <div class="item">
                            <img src="/img/instituciones_respaldo/fundaciontelefonica.png" alt="" class="img-fluid" style="max-width: 200px; padding-top: 20px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <page-footer/>
		
        <modal-login-register
			:csrf="this.csrf"
			:href_login="this.href_login"
			:href_register="this.href_register"
			:href_reset_password="this.href_reset_password"
		/>
    </main>
</template>

<script>
	import {vegas} from 'vegas/dist/vegas'

    export default {
        props: [
    		'data',
    		'csrf',
    		'href_login',
    		'href_register',
    		'href_reset_password',
        ],
        mounted() {
            const silder_respaldo = Tiny.tns({
                container: '#carousel-respaldo',
                autoplay: true,
                mouseDrag: true,
                controls: false,
                nav: false,
                autoplayButtonOutput: false,
                autoWidth: true,
                gutter: 20,
                rewind: true,
			});
			
			
			const el = document.querySelector('#homeBanner');
			$('#homeBanner').vegas({
				overlay: true,
				transition: 'fade', 
				transitionDuration: 4000,
				delay: 10000,
				animation: 'random',
				animationDuration: 20000,
				slides: [
					{src: '/img/banner/banner1.jpg' },
					{src: '/img/banner/banner2.jpg' },
					{src: '/img/banner/banner3.jpg' },
					{src: '/img/banner/banner4.jpg' },
				]
			})
        }
    }
</script>

<style>
    .titulo_seccion h3 {
        font-family: 'Nunito', sans-serif;
        text-align: center;
        font-weight: 600;
    }

    .titulo_seccion h5 {
        font-family: 'Nunito', sans-serif;
        text-align: center;
        font-weight: 400;
        margin-bottom: 40px;
    }

    .seccion_ofertas {
        background-color: #ebebeb;
    }

    .oferta-img {
        border-radius: 20px;
    }

    .seccion_respaldo {
        padding: 80px 0;
        vertical-align: middle;
    }

    .seccion_respaldo .item {
        display: flex;
        flex-flow: row wrap;
    }

    .seccion_respaldo .item img {
        max-width: 90%;
        padding: auto;
    }
    
    .imagenes-resplado > * {
        vertical-align: middle;
    }
</style>
