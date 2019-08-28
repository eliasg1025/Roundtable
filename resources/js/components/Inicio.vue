<template>
    <div>
        <Banner/>
        <CompradoresDestacados :data="this.data.featuredBuyers"/>
        <VendedoresDestacados :data="this.data.featuredSellers"/>
        <MasVisitados :data="this.data.mostViewedCompanies"/>
        <Ofertas/>
        <Categorias :data="this.data.categories"/>
        <Footer/>
		<ModalLoginRegister/>
    </div>
</template>

<script>
export default {
    props: [
        'data'
    ],
    data() {
        return {
			//
        }
    },
    created() {
        /* console.log(this.data.featuredBuyers);
        console.log(this.data.featuredSellers);
        console.log(this.data.mostViewedCompanies);
        console.log(this.data.categories); */
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
</style>
