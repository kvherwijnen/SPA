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

import Vue from 'vue';
import VueCompositionApi from "@vue/composition-api";
import { longClickDirective } from 'vue-long-click/dist/libs/vue-long-click.umd.min';
import Storage from 'vue-ls';
const DynamicIcon = () => import(/* webpackChunkName: "dynamic-icon-component" */ '../../layout/icons/Dynamic');

const options = {
    namespace: 'sheep_ai_camera__', // key prefix
    name: 'ls', // name variable Vue.[ls] or this.[$ls],
    storage: 'local', // storage name vsession, local, memory
};

const longClickInstance = longClickDirective({delay: 800, interval: null});
Vue.directive('longclick', longClickInstance);


const plugins = {
    install(Vue) {
        Vue.use(VueCompositionApi);
        Vue.use(Storage, options);
        Vue.component('DynamicIcon', DynamicIcon);
        Vue.component('StaticPageTemplate', () => import( /* webpackChunkName: "static-page-template" */  'Templates/pages/Static'));
        Vue.component('OverlayPageTemplate', () => import( /* webpackChunkName: "overlay-page-template" */  'Templates/pages/Overlay'));
        Vue.component('CollapseTransition', () => import( /* webpackChunkName: "collapse-transition" */  'element-ui/lib/transitions/collapse-transition'));
        Vue.prototype.$companyName =  process.env.MIX_COMPANY_NAME;
        Vue.prototype.$hueTypes = ['bridge', 'rooms', 'lights', 'sensors', 'resourcelinks'];
    }
}


export default plugins;
