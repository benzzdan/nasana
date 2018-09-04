import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';

//Authentications libraries
import VueAuth from '@websanova/vue-auth';
import VueAuthAuth from '@websanova/vue-auth/drivers/auth/bearer.js';
import VueAuthHttp from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import VueAuthRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x.js';

//Components
import Home from './components/Home';
import App from './components/App';
import Login from './components/Login';
import Register from './components/Register';
import Dashboard from './components/Dashboard';
import Account from './components/Account';

//Libraries
import 'bulma-start/css/main.css';
import _ from 'lodash';
require('./bootstrap');

import VueCookie from 'vue-cookie';




window.Vue = require('vue');
window.axios = axios;


Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueCookie)

let rootUrl = process.env.MIX_ROOT_URL
let apiPort = process.env.MIX_API_PORT


axios.defaults.baseURL = rootUrl + ':' + apiPort + '/api';


//Defining our routes

const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                //TODO: fix authentication after register make user logged in
                auth: true
            }
        },
        {
            path: '/cuenta',
            name: 'cuenta',
            component: Account,
            meta: {
                //TODO: fix authentication after register make user logged in
                auth: true
            }
        },
    ]
})


Vue.router = router

Vue.use(VueAuth, {
    auth: VueAuthAuth,
    http: VueAuthHttp,
    router: VueAuthRouter,
});




new Vue({
    el: '#app',
    router,
    components: {
        App
    },
    template: '<App/>',
    data() {
        return {
            msg: 'This is the home page!'
        }
    }
})