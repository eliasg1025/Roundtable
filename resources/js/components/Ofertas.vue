<template>
    <section class="ofertas container-fuild px-3 py-4">
        <div class="row">
            <div class="col-lg-6">
                <img src="/img/publicidad/banner1.jpg" class="oferta-img img-fluid" alt="">
            </div>
            <div class="col-lg-6">
                <img src="/img/publicidad/banner3.jpg" class="oferta-img img-fluid" alt="">
            </div>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {
        console.log('mounted');
    }
}
</script>

<style>
    .ofertas {
        background-color: #ebebeb;
    }

    .oferta-img {
        border-radius: 20px;
    }
</style>
