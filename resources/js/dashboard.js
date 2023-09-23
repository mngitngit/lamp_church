/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;

 Vue.component('pagination', require('./components/Common/Pagination.vue').default);
 Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
 Vue.component('dashboard-attendance-component', require('./components/AttendancePerLocalChurchComponent.vue').default);

 import Vue from 'vue';
 import ElementUI from 'element-ui';
 import 'element-ui/lib/theme-chalk/index.css';
 import '../css/app.css';
 import { Loading } from 'element-ui';
 
 import {func} from './func.js';

 import locale from 'element-ui/lib/locale/lang/en'
 
 Vue.prototype.$func = func
 
 // Loading.service({ fullscreen: true })
 
 Vue.config.lang = 'en'
 
 Vue.use(ElementUI, {locale});
  
 const app = new Vue({
     el: '#app',
     data: function() {
         return { 
             visible: false,
             search: null,
         }
     }
 });