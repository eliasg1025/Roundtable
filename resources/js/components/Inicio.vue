<template>
    <div>
        <main-banner/>
        <compradores-destacados :data="this.data.featuredBuyers"/>
        <vendedores-destacados :data="this.data.featuredSellers"/>
        <mas-visitados :data="this.data.mostViewedCompanies"/>
        <ofertas/>
        <categorias :data="this.data.categories"/>
        <page-footer/>
		<modal-login-register
			:csrf="this.csrf"
			:href_login="this.href_login"
			:href_register="this.href_register"
			:href_reset_password="this.href_reset_password"
		/>
    </div>
</template>

<script>

export default {
    props: [
		'data',
		'csrf',
		'href_login',
		'href_register',
		'href_reset_password',
    ]
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
