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
        <page-header :title="bridge.name ? bridge.name : 'Laden..'">
            <span @click="update" class="mr-2">
                <dynamic-icon name="magic-wand" typeGroup="settings"/>
            </span>
        </page-header>

        <div class="row d-flex justify-content-around mb-4">
            <s-avatar :size="60" style="border: 1px solid white;">
                <dynamic-icon name="bridge" typeGroup="settings" />
            </s-avatar>
        </div>

        <div class="row mb-4" v-show="edit">
            <input-text :placeholder="'Bridge van ' + user.lastName " :value="bridge.name ? bridge.name : 'Laden..'"
                        class="bg-trerty"/>
        </div>

        <div class="row">
            <h3>Kamers</h3>
        </div>

        <div class="row mb-4">
            <div class="col-12 px-0 pr-2 col-md-6 col-lg-4 col-xl-3 pl-md-2 pr-md-2 my-2"
                 v-for="item in rooms">
                <collapse-transition>
                    <hue-item :id='item.id' :object="item" type="rooms" v-if="item"/>
                </collapse-transition>
            </div>
        </div>

        <div class="row">
            <h3>Lampen</h3>
        </div>

        <div class="row d-flex justify-content-between mb-4">
            <div v-for="light in lights">
                <collapse-transition>
                    <hue-light :item="light" v-if="light"/>
                </collapse-transition>
            </div>
        </div>

        <div class="row">
            <h3>Sensors</h3>
        </div>

        <div class="row d-flex justify-content-between mb-4">
            <div class="card col-5 col-md-4 mx-1" v-for="item in sensors">
                <collapse-transition>
                    <div class="card-body text-white">
                        <strong v-text="item.name"/>
                    </div>
                </collapse-transition>
            </div>
        </div>
    </overlay-page-template>
</template>

<script>
    import { putHue } from "Core/helpers/async";
    import { mapGetters, mapState } from "vuex";
    import componentWidthDynamicModule from 'Core/utils/componentWithDynamicModule';

    const modules = ['bridge', 'rooms', 'lights', 'sensors'];

    export default {
        name: "BridgePage",
        extends: componentWidthDynamicModule(modules),

        components: {
            InputText: () => import( /* webpackChunkName: "input-component" */  'element-ui/lib/input'),
            SAvatar: () => import( /* webpackChunkName: "bridge-icon-holder-component" */  'element-ui/lib/avatar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader/index'),
            HueLight: () => import( /* webpackChunkName: "hue-light-component" */  '../components/HueLight'),
            HueItem: () => import( /* webpackChunkName: "hue-item-component" */  '../components/HueItem')
        },

        computed: {
            ...mapGetters({user: 'auth/user'}),
            ...mapState('bridge', {bridge: state => state.items}),
            ...mapState('rooms', {rooms: state => state.items}),
            ...mapState('lights', {lights: state => state.items}),
            ...mapState('sensors', {sensors: state => state.items}),
        },

        data() {
            return {
                refreshBridge: null,
                refreshRooms: null,
                refreshLights: null,
                edit: false
            }
        },

        async created() {
            await modules.forEach(type => this.$store.dispatch(`${type}/initialize`, type));
        },

        async mounted() {
            this.refreshBridge = setInterval(() => this.$store.dispatch(`bridge/fetch`, 'bridge'), 300000);

            this.refreshRooms = setInterval(() => this.$store.dispatch(`rooms/fetch`, 'rooms'), 10000);
            this.refreshLights = setInterval(() => this.$store.dispatch(`lights/fetch`, 'lights'), 12500);
        },

        methods: {
            async update() {
                const object = { name: this.bridge.name, }
                await putHue('bridge', 0, object, false).then(async () => await this.$router.back());
            }
        },

        beforeDestroy() {
            clearInterval(this.refreshBridge);

            clearInterval(this.refreshRooms);
            clearInterval(this.refreshLights);
        }
    }
</script>
