<template>
    <div>
        <Banner/>
        <CompradoresDestacados/>
        <VendedoresDestacados/>
        <MasVisitados/>
        <Ofertas/>
        <Categorias/>
        <Footer/>
    </div>
</template>

<script>
export default {
    props: [
        'data'
    ],
    data() {
        return {
            compradoresDestacados: [],
            vendedoresDestacados: [],
            moreViewed: [],
            company: {
                name: '',
                description: '',
                profile_img: '',
                cover_img: '',
                rating: ''
            }
        }
    },
    created() {
        console.log(this.data);
    }
}
</script>

<style>

</style>
