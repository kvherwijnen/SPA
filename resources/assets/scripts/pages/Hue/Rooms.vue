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
    <static-page-template>
        <div class="row d-flex justify-content-between">
            <div class="col-12 px-0 pr-2 col-md-8 pl-md-2 pr-md-2 py-2">
                <router-link to="/hue/bridge">
                    <s-button class="btn-block text-left">
                        <div class="d-flex justify-content-between flex-row">
                            <div class="d-flex pr-3">
                                <dynamic-icon name="bridge" typeGroup='settings'/>
                            </div>

                            <div class="d-block" style="line-height: 25px">
                                <span class="title text-strong"># DeurlooBridge</span><br/>
                                <span class="description mt-3">De Hue bridge Deurloo Bridge is momenteel online.</span>
                            </div>
                        </div>
                    </s-button>
                </router-link>
            </div>


            <div class="col-6 px-0 pr-2 col-md-2 pl-md-2 pr-md-2 my-2">
                <router-link to="/hue/lights">
                    <s-button class="btn-block h-100">
                        <dynamic-icon name="groupbulb" typeGroup='lights'/>
                    </s-button>
                </router-link>
            </div>

            <div class="col-6 px-0 pr-2 col-md-2 pl-md-2 pr-md-2 my-2">
                <router-link to="/hue/rooms/create">
                    <s-button class="btn-block h-100">
                        <dynamic-icon name="plus" typeGroup='settings'/>
                    </s-button>
                </router-link>
            </div>

            <div class="col-12 px-0 pr-2 col-md-6 col-lg-4 col-xl-3 pl-md-2 pr-md-2 my-2"
                 v-for="item in items">
                <hue-item :id='item.id' type="rooms" v-if="item"/>
            </div>
        </div>
    </static-page-template>
</template>

<script>
    import { mapState } from "vuex";
    import componentWidthDynamicModule from 'Core/utils/componentWithDynamicModule';

    const name = 'rooms';

    export default {
        name: "Rooms",
        extends: componentWidthDynamicModule(name),

        components: {
            SButton: () => import( /* webpackChunkName: "button-component" */  'element-ui/lib/button'),
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

        async mounted() {
            this.refresh = setInterval(() => this.$store.dispatch(`${name}/fetch`, name), 6000);
        },

        beforeDestroy() {
            clearInterval(this.refresh);
        }
    }
</script>

