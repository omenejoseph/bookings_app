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

const store = new Vuex.Store(
    storeData
);

import App from './components/App';
import Home from './components/HomeComponent';
import Example from './components/ExampleComponent';
import DashboardComponent from "./components/DashboardComponent";

axios.defaults.baseURL = '/api/v1';
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/example',
            name: 'example',
            component: Example
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: DashboardComponent
        }
    ],
});
const app = new Vue({
    el: '#app',
    components: {App},
    router,
    mode: 'history',
    store
});
