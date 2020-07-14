import Vue from 'vue';
import router from './core/router';
import plugins from "Core/plugins";
import store from './core/store';

require('offline-plugin/runtime').install({
    onInstalled: () => console.log("App is ready for offline usage")
});

const App = () => import( /* webpackChunkName: "app-wrapper" */ './App.vue');

// const token = localStorage.getItem('userToken')
// if (token) {
//     axios.defaults.headers.common['Authorization'] = token}

Vue.use(plugins);
Vue.config.productionTip = false;

new Vue({
    el: 'app',
    router,
    store,
    render: h => h(App)
}).$mount("#app");

Vue.prototype.$user = null;
