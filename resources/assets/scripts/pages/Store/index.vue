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
        <page-header title="Store"/>

        <div class="bar">
            <bar :icon="'colorloop'" type='scenes' :key="theme.id" v-for="theme in themes">
                <template #name>
                    {{theme.name}}
                </template>

                <template #text-right>
                    <span v-text="user.preferences.theme.id === theme.id ? 'Geinstalleerd' : 'Download'"/>
                </template>

                <template #right>
                    <span @click="user.preferences.updateTheme(theme.id)" class="d-inline-block my-auto">
                        <dynamic-icon :name="'confirmed'" typeGroup="settings" :color="user.preferences.theme.id === theme.id ? '#00f2c3' : '#FFFFFF'"/>
                    </span>
                </template>
            </bar>
            <div class="my-3"></div>

            <bar :icon="scene.getIcon()" type='scenes' :key="scene.id + 928384" v-for="scene in scenes">
                <template #name>
                    {{scene.name}}
                </template>

                <template #text-right>
                    Geinstalleerd
                </template>

                <template #right>
                    <dynamic-icon :name="'confirmed'" typeGroup="settings" :color="'#00f2c3'"/>
                </template>
            </bar>
        </div>
    </overlay-page-template>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Scene from 'Core/models/Scene';
    import Theme from 'Core/models/Theme';

    export default {
        name: 'Store',
        computed: mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user'
            })
        ,
        components: {
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
        },
        data() {
            return {
                themes: [],
                scenes: []
            }
        },

        async beforeMount() {
            await this.fetchThemes()
            await this.fetchScenes()
        },

        methods: {
            async fetchThemes() {
                await axios.get('themes').then(response => {
                    const themes = response.data;
                    themes.forEach(theme => {
                        this.themes.push(new Theme(theme))
                    })
                })
            },

            async fetchScenes() {
                await axios.get('scenes').then(response => {
                    const scenes = response.data;
                    scenes.forEach(scene => {
                        this.scenes.push(new Scene(scene))
                    })
                })
            }
        }
    }
</script>
