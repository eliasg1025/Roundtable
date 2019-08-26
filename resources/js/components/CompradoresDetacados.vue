<template>
    <section class="compradores_destacados container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="titulo_seccion">
                        <h3 class="text-uppercase">Compradores destacados</h3>
                        <h5>Las mejores empresas están aquí, encuéntralas</h5>
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
            name: 'compradores_destacados'
        }
    }
}
</script>

<style>
    .compradores_destacados {
        padding: 80px 0;
        background-image: url('/img/fondo/latest-product-bg.png');
        background-size: cover;
    }
</style>
