<template>
    <section class="mas_visitados container">
        <div class="row">
            <div class="col-lg-12">
                <div class="titulo_seccion">
                    <h3 class="text-uppercase">Empresas mas visitadas</h3>
                    <h5>Frutos orgánicos recién cosechados</h5>
                </div>
            </div>
            <div class="col-lg-12">
                <home-carousel-empresa
                    :name="this.name"
					:data="this.data">
                </home-carousel-empresa>
            </div>
        </div>
    </section >
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            name: 'empresas_mas_visitadas'
        }
    }
}
</script>

<style>
    .mas_visitados {
		padding: 0px 0px 80px 0px;
		background-image: url('/img/fondo/latest-product-bg.png');
        background-size: cover;
    }
</style>
