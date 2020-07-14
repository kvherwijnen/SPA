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
        <page-header :title="room.name">
            <span @click="create">
                <dynamic-icon name="magic-wand" typeGroup="settings"/>
            </span>
        </page-header>

        <div class="row d-flex justify-content-around mb-4" style="height: 100px;">
            <div @click='room.setIcon("-")' class="my-auto">
                <s-avatar class="my-auto" style="padding-right: 3px; border: 1px solid white;">
                    <dynamic-icon name="chevron" direction="left" typeGroup="settings"/>
                </s-avatar>
            </div>

            <div class="my-auto" style="width: 70px; height: 70px">
                <transition :name="room.lastTransition">
                    <s-avatar :key="room.class" :size="60" style="border: 1px solid white;">
                        <dynamic-icon :name="room.getIcon()" :typeGroup="'rooms'"/>
                    </s-avatar>
                </transition>
            </div>

            <div @click='room.setIcon("+")' class="my-auto">
                <s-avatar class="my-auto" style="padding-left: 3px; border: 1px solid white;">
                    <dynamic-icon name="chevron" direction="right" typeGroup="settings"/>
                </s-avatar>
            </div>
        </div>

        <div class="row mb-4">
            <input-text class="bg-trerty" placeholder="Slaapkamer" v-model="room.name"/>
        </div>

        <div class="row" v-if="lights">
            <h3>Lampkeuze</h3>
        </div>

        <div class='row d-flex justify-content-between'>
            <div @click="add(index)" v-for="(light, index) in lights" v-if="light">
                <hue-light :item="light" v-show="light"/>
            </div>
        </div>
    </overlay-page-template>
</template>

<script>
    import Room from "Core/models/Room";
    import { postHue } from "Core/helpers/async";
    import { mapState } from "vuex";

    export default {
        name: 'Create',

        components: {
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
            InputText: () => import( /* webpackChunkName: "input-component" */  'element-ui/lib/input'),
            SAvatar: () => import( /* webpackChunkName: "icon-holder-component" */  'element-ui/lib/avatar'),
            HueLight: () => import( /* webpackChunkName: "hue-light-component" */  '../components/HueLight')
        },

        computed: mapState('lights', {lights: state => state.items}),

        data() {
            return {
                room: new Room({
                    name: 'new',
                    class: 'Bedroom',
                    lights: []
                })
            }
        },

        methods: {
            async create() {
                const newRoom = {
                    name: this.room.name,
                    class: this.room.class,
                    type: 'Room'
                }
                await postHue('rooms', newRoom).then(async () => await this.$router.back());
            },

            async add(id) {
                const exists = this.room.lights.includes(id);

                if (exists)
                    this.room.lights = this.room.lights.filter((c) => {
                        return c !== id
                    });

                else
                    return this.room.lights.push(id.toString());
            }
        }
    }
</script>
