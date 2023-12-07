/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// admin portal
Vue.component('online-checkin', require('./components/CheckInComponent.vue').default);
Vue.component('checkin-passes', require('./components/CheckInPassesComponent.vue').default);

import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import '../css/app.css';
import { Loading } from 'element-ui';
import VueQRCodeComponent from 'vue-qrcode-component'

import { func } from './func.js';

import locale from 'element-ui/lib/locale/lang/en'

Vue.prototype.$func = func

// Loading.service({ fullscreen: true })

Vue.config.lang = 'en'

Vue.use(ElementUI, { locale });

Vue.component('qr-code', VueQRCodeComponent);

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            visible: false,
            search: null,
        }
    }
});