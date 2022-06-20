
require('./bootstrap');

window.Vue = require('vue').default;

//Support Vue Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Filter | formating
import {filter} from './filter'

//Support V-Form
import { Form, HasError, AlertError } from 'vform'
window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//support Vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import stores from './store/index'
const store = new Vuex.Store(
    stores
)

//Support Editor
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor'
// global register
Vue.use(Editor);

//Sweet Alert 2 Support
import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Toast = Toast


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-home', require('./components/admin/AdminMaster.vue').default);
Vue.component('public-master', require('./components/public/PublicMaster.vue').default);

//Vue Router Instance
import {routes} from './routes'
const router = new VueRouter({
    routes // short for `routes: routes`
  })


const app = new Vue({
    el: '#app',
    router,
    store
});
