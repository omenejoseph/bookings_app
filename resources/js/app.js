/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
require('./bootstrap');

Vue.use(VueRouter);

import Vuex from 'vuex';
Vue.use(Vuex);
import storeData from "./store/index";
import {authenticated, unauthenticated} from "./middlewares/auth";

const store = new Vuex.Store(
    storeData
);

import App from './components/App';
import Home from './components/HomeComponent';
import Example from './components/ExampleComponent';
import DashboardComponent from "./components/DashboardComponent";
import CreateUserComponent from "./components/CreateUserComponent";
import CreateBookingComponent from "./components/CreateBookingComponent";

axios.defaults.baseURL = '/api/v1';
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                middleware: [unauthenticated]
            }
        },
        {
            path: '/example',
            name: 'example',
            component: Example
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardComponent,
            meta: {
                middleware: [authenticated]
            },
            props: true
        },
        {
            path: '/create-user',
            name: 'create-user',
            component: CreateUserComponent,
            meta: {
                middleware: [authenticated]
            }
        },
        {
            path: '/create-booking',
            name: 'create-booking',
            component: CreateBookingComponent,
            meta: {
                middleware: [authenticated]
            },
            props: true
        },
        {
            path: '/update-booking/:id',
            name: 'update-booking',
            component: CreateBookingComponent,
            meta: {
                middleware: [authenticated]
            },
            props: true
        },
    ],
});
router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware;
    const context = {
        next,
        router
    };
    return middleware[0]({
        ...context
    });
});

const app = new Vue({
    el: '#app',
    components: {App},
    router,
    mode: 'history',
    store
});
