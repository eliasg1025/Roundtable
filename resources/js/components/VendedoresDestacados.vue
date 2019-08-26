<template>
    <section class="vendedores_destacados container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="text-uppercase">Vendores Destacados</h3>
                        <h5>Encuentra rápido y seguro, los mejores productos peruanos...</h5>
                    </div>
                </div>
                <div class="col-lg-12">
                    <CarouselEmpresa
                        :name="this.name"
						:data="this.data">
                    </CarouselEmpresa>
                </div>
            </div>
    </section>
</template>

<script>
export default {
    props: ['data'],
    data() {
        return {
            name: 'vendedores_destacados'
        }
    }
}
</script>

<style>
    .vendedores_destacados {
        padding: 0px 0px 80px 0px;
        background-image: url('/img/fondo/latest-product-bg.png');
        background-size: cover;
    }
</style>
