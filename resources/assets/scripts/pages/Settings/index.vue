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
    <overlay-page-template>
        <page-header title="Instellingen"/>

        <div class="bar">
            <div class="bar-top">
                <div class="container d-flex flex-column justify-content-start">
                    <s-avatar :size="60" :user="$user" class="mx-auto" v-if="$user"/>
                    <div class="text-center my-2" v-text="$user.getFullName()">
                    </div>
                </div>
            </div>

            <bar>
                <template #name>
                    Dark mode
                </template>
                <template #text-right>
                    <vs-switch @click="update" dark v-model="dark_mode">
                        <template #circle>
                            <dynamic-icon name="moon" :color="'#000'" typeGroup="settings" v-if="!dark_mode"/>
                            <dynamic-icon name="sun" :color="'#000'" typeGroup="settings" v-else/>
                        </template>
                    </vs-switch>
                </template>
                <template #right>
                    <span/>
                </template>
            </bar>

            <bar>
                <template #name>
                    Do not Disturb
                </template>
                <template #text-right>
                    <mute-button></mute-button>
                </template>
                <template #right>
                    <span/>
                </template>
            </bar>

            <bar :icon="'light-group'" :type="'lights'">
                <template #name>
                    <span class="text-danger" @click="resetHue">Reset Hue</span>
                </template>
                <template @click="resetHue" #right>
                    <span/>
                </template>
            </bar>

            <router-link to="/appearance">
                <bar>
                    <template #name>
                        Appearance
                    </template>
                </bar>
            </router-link>

            <bar :key="row" v-for="row in rows">
                <template #name>
                    <span v-text="row ? 'Optie ' + row : 'Optie ' + row" />
                </template>
            </bar>

            <vs-button :animate-inactive="false" :loading="loadingFace" gradient @click="logout" class="btn-logout" :color="$user.preferences.theme.primary">
                <dynamic-icon name="power-off" typeGroup="settings" :size="18"/>

                <template #animate>
                   Uitscheppen
                </template>
            </vs-button>
        </div>
    </overlay-page-template>
</template>

<script>
    export default {
        name: 'Settings',
        components: {
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            MuteButton: () => import( /* webpackChunkName: "mute-button-component"  */  'GlobalComponents/MuteButton'),
            VsButton: () => import( /* webpackChunkName: "vs-Button-component" */ 'vuesax/dist/vsButton'),
            VsSwitch: () => import( /* webpackChunkName: "vs-switch-component" */ 'vuesax/dist/vsSwitch'),
            SAvatar: () => import( /* webpackChunkName: "s-avatar-component" */  'GlobalComponents/Avatar/State'),
        },
        data() {
            return {
                available: false,
                hueLoading: false,
                dark_mode: false,
                loadingFace: false,
                rows: 9
            }
        },

        methods: {
            async resetHue() {
                this.hueLoading = true;

                await axios.get('hue/auth')
                    .then(response => {
                        const URL = response.data;
                        console.log(URL);
                        window.open(URL);
                        this.hueLoading = false;
                    });
            },
            async logout() {
                this.loadingFace = true;
                return setTimeout(async () => await this.$router.push('/logout'), 800);
            },
            async update() {
                return console.log('dark_mode toggle')
            }
        }
    }
</script>
