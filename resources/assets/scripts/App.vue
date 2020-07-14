<!--
  - :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
  -
  - Copyright (c) 2020
  - All Rights Reserved
  - Licensed use only
  -
  - This product is part of the SheepCompany Incorporated
  -
  -
  - LICENSE BY:
  - Artificial Intelligence :: Sheep-AI.com
  - More information: LICENSE.txt
  -
  - :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
  -->

<template>
    <div>
        <network-alert/>

        <transition name="fade" type="out-in">
            <span v-if="authenticated && authChecked">
                <div :class="user.preferences.theme.id === 1 ? 'squares square1' :  'squares squares-' + user.preferences.theme.id +' square1'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square2' :  'squares squares-' + user.preferences.theme.id +' square2'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square3' :  'squares squares-' + user.preferences.theme.id +' square3'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square4' :  'squares squares-' + user.preferences.theme.id +' square4'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square5' :  'squares squares-' + user.preferences.theme.id +' square5'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square6' :  'squares squares-' + user.preferences.theme.id +' square6'"/>
                <div :class="user.preferences.theme.id === 1 ? 'squares square7' :  'squares squares-' + user.preferences.theme.id +' square7'"/>
            </span>
        </transition>

        <transition name="fade" type="out-in">
            <app-header v-if="authenticated && authChecked"/>
        </transition>

        <div class="wrapper page-header" v-if="authChecked">
            <page-transition>
                <router-view class="child-wrapper" style="height: auto"/>
            </page-transition>
        </div>

        <div class="wrapper page-header" v-else>
            <transition name="fade" type="out-in">
                <div class="child-wrapper">
                    <div class="d-flex flex-row justify-content-around h-100">
                        <div class="auth-wrapper my-auto">
                            <div class="auth-logo">
                                <strong>Artificial</strong>Intelligence
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <transition name="fade" type="out-in">
            <app-footer v-if="authenticated && authChecked"/>
        </transition>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'App',
        components: {
            AppHeader: () => import( /* webpackChunkName: "app-header" */ './layout/partials/Header'),
            PageTransition: () => import( /* webpackChunkName: "page-transition-component" */ './layout/components/PageTransition'),
            AppFooter: () => import( /* webpackChunkName: "footer-component" */  './layout/partials/Footer'),
            AuthSection: () => import( /* webpackChunkName: "footer-component" */  './pages/Authentication'),
            NetworkAlert: () => import( /* webpackChunkName: "network-alert-component" */ 'GlobalComponents/NetworkAlert')
        },

        computed: mapGetters({authenticated: 'auth/authenticated', user: 'auth/user'}),

        data() {
            return {
                authChecked: false
            }
        },

        async beforeMount() {
            setTimeout(async () => {
                let authenticated = await this.$auth.check();

                if (authenticated && this.user === null) {
                    const user = await this.$auth.user();

                    await this.setAuth(user)
                            .then(() => setTimeout(() => this.authChecked = true, 50));
                } else this.authChecked = true;
            }, 500);
        },

        methods: mapActions({ setAuth: 'auth/setAuth' })
    }
</script>
