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

Vue.component('Inicio', require('./components/Inicio.vue').default);
Vue.component('Banner', require('./components/Banner.vue').default);
Vue.component('CompradoresDestacados', require('./components/CompradoresDetacados.vue').default);
Vue.component('VendedoresDestacados' ,require('./components/VendedoresDestacados.vue').default);
Vue.component('Ofertas', require('./components/Ofertas.vue').default);
Vue.component('MasVisitados' ,require('./components/MasVisitados.vue').default);
Vue.component('Categorias' ,require('./components/Categorias.vue').default);
Vue.component('Footer' ,require('./components/Footer.vue').default);
Vue.component('CarouselEmpresa', require('./components/CarouselEmpresa.vue').default);
Vue.component('BoxEmpresa', require('./components/BoxEmpresa.vue').default);

const app = new Vue({
    el: '#app',
});

require('./carousel');
