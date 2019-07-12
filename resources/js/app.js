//requerimos el archivos bootstrap
require('./bootstrap');

//requerimos vue
window.Vue = require('vue');

//Componentes
Vue.component('sale-component', require('./components/SaleComponent.vue').default);
Vue.component('consultation-component', require('./components/Consultation.vue').default);

//importamos un componente externo select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

//para la url publica de nuestra aplicación
Vue.prototype.$appUrl = 'http://mastergis.test/';
// Vue.prototype.$appUrl = 'http://mastergis.herokuapp.com/';
// Vue.prototype.$appUrl = 'http://borisalfredo.com/';

//instacia de vue
const app = new Vue({
    el: '#app'
});
