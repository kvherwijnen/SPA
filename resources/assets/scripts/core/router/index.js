/*
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

import Vue from "vue";
import VueRouter from "vue-router";
import authorize from "../plugins/auth";
import VueAxios from "vue-axios";
import axios from "axios";
import routes from "./routes";

window.axios = axios;
axios.defaults.baseURL = '/api/';
axios.defaults.maxRedirects = 3;
axios.defaults.withCredentials = true;
Vue.use(VueAxios, axios);

export const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: routes

});

Vue.router = router;
Vue.use(VueRouter);

//
// router.beforeEach((to, from, next) => {
//     store.dispatch('fetchAccessToken');
//     if (to.fullPath === '/users') {
//         if (!store.state.accessToken) {
//             next('/login');
//         }
//     }
//     if (to.fullPath === '/login') {
//         if (store.state.accessToken) {
//             next('/users');
//         }
//     }
//     next();
// });


Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    rolesKey: 'roles',
    authorize
});

export default router;
