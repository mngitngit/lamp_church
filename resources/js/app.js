/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// registration page
Vue.component('registration-component', require('./components/RegistrationComponent.vue').default);
Vue.component('barcode-component', require('./components/BarcodeComponent.vue').default);
Vue.component('ticket-component', require('./components/TicketComponent.vue').default);
Vue.component('banner-component', require('./components/BannerComponent.vue').default);
Vue.component('find-data-component', require('./components/FindDataComponent.vue').default);

// admin portal
Vue.component('registration-table', require('./components/RegistrationsTableComponent.vue').default);
Vue.component('payments-table', require('./components/PaymentsTableComponent.vue').default);
Vue.component('add-payment', require('./components/AddPaymentComponent.vue').default);

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import '../css/app.css';
import { Loading } from 'element-ui';

import {func} from '../js/func.js';

import locale from 'element-ui/lib/locale/lang/en'

Vue.prototype.$func = func

// Loading.service({ fullscreen: true })

Vue.config.lang = 'en'

Vue.use(ElementUI, {locale});

var JsBarcode = require('jsbarcode');

Vue.prototype.$dateWithTime = function(date) {
    var options = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric' };
    var today  = new Date();

    return today.toLocaleDateString("en-US", options);
}

const app = new Vue({
    el: '#app',
    data: function() {
        return { visible: false }
    },
    methods: {
        callFormSubmit: function() {
            this.$refs.child.formSubmit()
        }
    }
});
