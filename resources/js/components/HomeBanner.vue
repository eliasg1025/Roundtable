<template>
    <section class="banner" id="homeBanner" style="">
        <div class="mask rgba-black-light align-item-center">
            <div class="container">
                <div class="row">
                    <div class="contenido col-md-12 mb-4 white-text text-center">
                        <h1 class="title h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5"><strong>Roundtable Perú</strong></h1>

                        <h5 class="subtitle text-uppercase mt-3 mb-4 white-text"><strong>La Rueda de Negocios Online de Productos Peruanos</strong></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {vegas} from 'vegas/dist/vegas'

export default {
	created() {
		
	}
}

</script>

<style>
	/*
	#homeBanner {
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center center;
	}
	*/

    .banner {
    	height: 100vh;
        color: #f8fafc !important;
		background-attachment: fixed;
		position: relative;
	}

	@media (max-width: 1100px) {
		.banner {
			background-attachment: inherit;
		}
	}

	@media (max-width: 578px) {
		.banner {
			width: 100vmin;
		}

		.title {
			font-size: 30px;
		}

		.subtitle {
			font-size: 15px;
		}
	}

	/*
	.banner:before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #000;
		opacity: .2;
	}
	*/
    .top-nav-collapse {
        background-color: #09122E !important;
    }

    .navbar:not(.top-nav-collapse) {
        background: transparent;
    }

    @media (max-width: 991px) {
        .navbar:not(.top-nav-collapse) {
            background: #09122E !important;
        }
    }

    .title {
		letter-spacing: 6px;
		font-family: 'Roboto', sans-serif;
		/* font-family: 'Amatic SC', cursive; */
    }

    .subtitle {
		letter-spacing: 2px;
		font-family: 'Nunito', sans-serif;
    }

    .hr-light {
        border-top: 3px solid #fff;
        width: 80px;
    }

    .contenido {
        margin-top: 40vh;
    }

    nav.scroll {
        background-color: #09122E;
    }
</style>
