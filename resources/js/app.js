/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// registration page
Vue.component('registration-component', require('./components/RegistrationComponent.vue').default);
Vue.component('edit-registration-component', require('./components/EditRegistrationComponent.vue').default);
Vue.component('barcode-component', require('./components/BarcodeComponent.vue').default);
Vue.component('ticket-component', require('./components/TicketComponent.vue').default);
Vue.component('banner-component', require('./components/BannerComponent.vue').default);
Vue.component('find-data-component', require('./components/FindDataComponent.vue').default);

// admin portal
Vue.component('activites-table', require('./components/ActivitiesTableComponent.vue').default);

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import '../css/app.css';
import { Loading } from 'element-ui';

import {func} from '../js/func.js';

import locale from 'element-ui/lib/locale/lang/en'

import { allCountries } from '../js/countries';
Vue.prototype.$allCountries = allCountries

Vue.prototype.$func = func

// Loading.service({ fullscreen: true })

Vue.config.lang = 'en'

Vue.use(ElementUI, {locale});

var JsBarcode = require('jsbarcode')

const app = new Vue({
    el: '#app',
    data: function() {
        return { 
            visible: false,
            search: null,
        }
    }
});
