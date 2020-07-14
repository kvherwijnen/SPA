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
        <page-header title="users"/>

        <div class="row">
            <div class="col-12 px-0 col-md-6 col-lg-4 col-xl-3 pl-md-2 pr-md-2 my-2"
                 v-for="item in items">
                {{item}}
            </div>
        </div>
    </overlay-page-template>
</template>

<script>
    import { mapState } from "vuex";
    import componentWidthDynamicModule from 'Core/utils/componentWithDynamicModule';

    const name = 'sensors';

    export default {
        name: "sensors",
        extends: componentWidthDynamicModule(name),

        components: {
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
            HueItem: () => import( /* webpackChunkName: "hue-universal-item-component" */ './components/HueItem')
        },

        data() {
            return {
                refresh: null
            }
        },

        computed: mapState(name, {items: state => state.items}),

        async created() {
            await this.$store.dispatch(`${name}/initialize`, name)
        },

        mounted() {
            this.refresh = setInterval(() => this.$store.dispatch(`${name}/fetch`, name), 4500);
        },

        beforeDestroy() {
            clearInterval(this.refresh);
        }
    }
</script>
