'use strict'

import Vue from 'vue'
import axios from 'axios'

import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false
Vue.prototype.$http = axios.create({
    baseURL: 'http://pasback.local/',
    emulateJSON: true
})

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
