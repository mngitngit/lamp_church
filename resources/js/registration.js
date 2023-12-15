/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// admin portal
Vue.component('registration-table', require('./components/RegistrationsTableComponent.vue').default);
Vue.component('lookups-table', require('./components/LookUpsTableComponent.vue').default);
Vue.component('booking-table', require('./components/BookingTableComponent.vue').default);
Vue.component('attendance-table', require('./components/AttendanceTableComponent.vue').default);
Vue.component('attendances-table', require('./components/AttendancesTableComponent.vue').default);
Vue.component('slots-table', require('./components/SlotsTableComponent.vue').default);
Vue.component('upload-component', require('./components/UploadComponent.vue').default);
Vue.component('pagination', require('./components/Common/Pagination.vue').default);
Vue.component('ticket-component', require('./components/TicketComponent.vue').default);


import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import '../css/app.css';
import { Loading } from 'element-ui';

import { func } from './func.js';

import locale from 'element-ui/lib/locale/lang/en'

Vue.prototype.$func = func

// Loading.service({ fullscreen: true })

Vue.config.lang = 'en'

Vue.use(ElementUI, { locale });

const app = new Vue({
    el: '#app',
    data: function () {
        return {
            visible: false,
            search: null,
        }
    }
});