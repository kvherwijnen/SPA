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
    <tabs @tab-click="navigate" class="footer fixed-bottom" stretch tab-position="bottom" v-model="tab">
        <tab-pane :key='route.name' :name='route.path' v-for="route in routes"
                  v-if="route.name !== 'Rooms' || (route.name === 'Rooms') && $user.preferences.hue_installed">
            <span slot="label">
                <dynamic-icon :color="(route.path === tab) ? $user.preferences.theme.primary : 'rgba(255,255,255,0.44)'" :name="route.meta.icon ? route.meta.icon : 'digg'" :typeGroup="route.meta.iconType ?  route.meta.iconType : 'settings'"
                           :size="22"/>
                <small :style="{ color: (route.path === tab) ? $user.preferences.theme.primary : '#FFFFFF70'}" v-text="route.name"/>
            </span>
        </tab-pane>
    </tabs>
</template>

<script>
    import globalRoutes from "Core/router/routes/global";

    export default {
        name: 'Footer',
        components: {
            Tabs: () => import( /* webpackChunkName: "footer-tabs" */ 'element-ui/lib/tabs'),
            TabPane: () => import( /* webpackChunkName: "footer-tab-pane" */ 'element-ui/lib/tab-pane')
        },

        data() {
            return {
                routes: [],
                tab: this.$router.currentRoute.path,
            }
        },

        watch: {
            '$route'(to) {
                this.tab = to.path
            }
        },

        async mounted() {
            this.getVisibleRoutes();
        },

        methods: {
            getVisibleRoutes() {
                globalRoutes.forEach(route => {
                    if (!route.hidden)
                        this.routes.push(route);
                })
            },
            async navigate() {
                if (this.tab !== this.$route.path)
                    await this.$router.onReady(async () => await this.$router.push(this.tab));
            }
        }
    }
</script>
