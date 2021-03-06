
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter 						from 'vue-router';
import VueAxios  						from 'vue-axios';
import axios 	 						from 'axios';
import App 								from './app.vue';
import { Form, HasError, AlertError } 	from 'vform';
import VueProgressBar 					from 'vue-progressbar';
import swal								from 'sweetalert2';

window.Swal = swal;

window.Form = Form;

window.Fire = new Vue();

const toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;

Vue.use(VueRouter);
Vue.use(VueAxios,axios);
Vue.component(HasError.name,   HasError);
Vue.component(AlertError.name, AlertError);

const options = {
  color: '#38c172',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false
}

Vue.use(VueProgressBar,options);

Vue.component('pagination', require('laravel-vue-pagination'));

import ReferralComponent from './components/ReferralComponent.vue';

const routes  = [

	{

		name:'referrals',

		path:'/referrals',

		component: ReferralComponent

	}


];

const router = new VueRouter( { mode: 'history' }, routes );
const app = new Vue( Vue.util.extend( { router }, App )).$mount('#app');



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*
const app = new Vue({
    el: '#app',
	  
});
*/

