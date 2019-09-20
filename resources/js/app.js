require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// UI Components
Vue.component('PageBanner', require('./components/PageBanner.vue').default);
Vue.component('PageFooter' ,require('./components/PageFooter.vue').default);
Vue.component('ModalLoginRegister', require('./components/ModalLoginRegister').default);

// Home page components
/*
Vue.component('Inicio', require('./components/Inicio.vue').default);
Vue.component('mainBanner', require('./components/Banner.vue').default);
Vue.component('CompradoresDestacados', require('./components/CompradoresDetacados.vue').default);
Vue.component('VendedoresDestacados' ,require('./components/VendedoresDestacados.vue').default);
Vue.component('Ofertas', require('./components/Ofertas.vue').default);
Vue.component('MasVisitados' ,require('./components/MasVisitados.vue').default);
Vue.component('Categorias' ,require('./components/Categorias.vue').default);
Vue.component('CarouselEmpresa', require('./components/CarouselEmpresa.vue').default);
Vue.component('BoxEmpresa', require('./components/BoxEmpresa.vue').default);*/


Vue.component('Spinner', require('./components/Spinner.vue').default);
Vue.component('CardBusiness', require('./components/CardBusiness.vue').default);
Vue.component('RatingStars', require('./components/RatingStars.vue').default);

// Home page
Vue.component('Home', require('./components/Home.vue').default);
Vue.component('HomeBanner', require('./components/HomeBanner.vue').default);
Vue.component('HomeCompradoresDestacados', require('./components/HomeCompradoresDetacados.vue').default);
Vue.component('HomeVendedoresDestacados' ,require('./components/HomeVendedoresDestacados.vue').default);
Vue.component('HomeMasVisitados' ,require('./components/HomeMasVisitados.vue').default);
Vue.component('HomeCategorias' ,require('./components/HomeCategorias.vue').default);
Vue.component('HomeCarouselEmpresa', require('./components/HomeCarouselEmpresa.vue').default);

// Reset password page
Vue.component('ResetPassword', require('./components/ResetPassword.vue').default);


// Profile page
Vue.component('Profile', require('./components/Profile.vue').default);

// Business Profile page
Vue.component('Business', require('./components/Business.vue').default);
Vue.component('BusinessBanner', require('./components/BusinessBanner.vue').default);
Vue.component('BusinessVideos', require('./components/BusinessVideos.vue').default);
Vue.component('BusinessImages', require('./components/BusinessImages.vue').default);
Vue.component('BusinessProducts', require('./components/BusinessProducts.vue').default);

//planes
Vue.component('planes', require('./components/Planes.vue').default);
Vue.component('puntos',require('./components/puntos.vue').default);
//contacto
Vue.component('contacto', require('./components/contacto.vue').default);

// Search business page
Vue.component('Search', require('./components/Search.vue').default);
Vue.component('SearchBar', require('./components/SearchBar.vue').default);
Vue.component('SearchCategorySidebar', require('./components/SearchCategorySidebar.vue').default);
Vue.component('SearchGrid', require('./components/SearchGrid.vue').default);

const app = new Vue({
	el: '#app',
});

require('./carousel');
require('./helpers');
