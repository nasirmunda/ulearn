/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

//Import Vue Filter
require('./filter'); 

//Import progressbar
require('./progressbar'); 

//Setup custom events 
require('./customEvents'); 

//Import View Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Import Sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast

//Import v-from
import Form from 'vform'
//import HasError from 'vform'
//import AlertError from 'vform'

window.Form = Form;

//Vue.component(HasError.name, HasError)
//Vue.component(AlertError.name, AlertError)

//Routes
import { routes } from './routes';

//Register Routes
const router = new VueRouter({
    mode: 'history',
    routes, 
})

Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('course-details', require('./components/CourseDetailsComponent.vue').default);
Vue.component('about', require('./components/AboutComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('dashboard', require('./components/admin/DashboardComponent.vue').default);
Vue.component('profile', require('./components/admin/ProfileComponent.vue').default);
Vue.component('educator', require('./components/admin/EducatorComponent.vue').default);
Vue.component('student', require('./components/admin/StudentComponent.vue').default);


const app = new Vue({
    el: '#app',
    router
});
