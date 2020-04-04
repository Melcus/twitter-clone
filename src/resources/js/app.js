require('./bootstrap');
window.Vue = require('vue');

import Vuex from 'vuex'
Vue.use(Vuex);

import VueObserveVisibilityPlugin from "vue-observe-visibility";
Vue.use(VueObserveVisibilityPlugin);

import {InlineSvgPlugin} from 'vue-inline-svg';
Vue.use(InlineSvgPlugin);

Vue.prototype.$user = User;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import timeline from "./store/timeline";
import likes from "./store/likes";

const store = new Vuex.Store({
    modules: {
        timeline,
        likes
    }
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
