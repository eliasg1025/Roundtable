<template>
    <section class="banner" style="background-image: url('/img/slider/prueba.jpeg');  background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-black-light align-item-center">
            <div class="container">
                <div class="row">
                    <div class="contenido col-md-12 mb-4 white-text text-center">
                        <h1 class="title h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown"><strong>Rountable Perú</strong></h1>
                        <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                        <h5 class="subtitle text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s"><strong>La Rueda de Negocios Online de Productos Peruanos</strong></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {
        console.log('Banner mounted');
    }
}

window.onscroll = () => {
    const nav = document.querySelector('#navbar');
    if(window.scrollY <= 20) {
        nav.style = ''
    } else {
        nav.style = "background-color: #09122e;"
    };
};

</script>

<style>
    .banner {
        height: 100vh;
        /*background-attachment: fixed;*/
        color: #f8fafc !important;
        font-family: 'Roboto', sans-serif;
        background-attachment: fixed;
    }

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
        letter-spacing: 8px;
    }

    .subtitle {
        letter-spacing: 3px;
    }

    .hr-light {
        border-top: 3px solid #fff;
        width: 80px;
    }

    .contenido {
        margin-top: 25%;
    }

    nav.scroll {
        background-color: #09122E;
    }
</style>
