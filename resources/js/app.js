/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './Form'
window.Form = Form;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('comment-component', require('./components/CommentComponent.vue').default);
Vue.component('post-component', require('./components/PostComponent.vue').default);
Vue.component('page-component', require('./components/PageComponent.vue').default);
Vue.component('create-page-component', require('./components/CreatePageComponent.vue').default);
Vue.component('create-post-component', require('./components/CreatePostComponent.vue').default);
Vue.component('edit-post-component', require('./components/EditPostComponent.vue').default);
Vue.component('account-component', require('./components/AccountComponent.vue').default);
Vue.component('find-pages-component', require('./components/FindPagesComponent.vue').default);
Vue.component('home-component', require('./components/HomeComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
