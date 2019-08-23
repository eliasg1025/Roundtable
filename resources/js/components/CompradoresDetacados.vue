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
                    <BoxEmpresa/>
                </div>
            </div>
    </section>
</template>

<script>
export default {

}
</script>

<style>
    .titulo_seccion h3 {
        font-family: 'Kalam', sans-serif;
        text-align: center;
        font-weight: 600;
    }
    .titulo_seccion h5 {
        font-family: 'Nunito', sans-serif;
        text-align: center;
        font-weight: 400;
        margin-bottom: 40px;
    }
    .compradores_destacados {
        padding: 80px 0;
        background-image: url('/img/fondo/latest-product-bg.png');
        background-size: cover;
    }
</style>
