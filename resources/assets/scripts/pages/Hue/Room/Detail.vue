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
        <page-header :title="room ? room.name : 'Laden...'">
            <el-dropdown>
                <h2 class="mr-2 mb-0">
                    <dynamic-icon name="magic-wand" typeGroup="settings"/>
                </h2>

                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item v-text="'Sensors'"/>

                    <span @click="save">
                        <el-dropdown-item v-text="'Wijzigingen opslaan'"/>
                    </span>

                    <span @click="remove">
                        <el-dropdown-item class="font-weight-bold text-danger" v-text="'Verwijder kamer'"/>
                    </span>
                </el-dropdown-menu>
            </el-dropdown>
        </page-header>


        <div class='row d-flex justify-content-around mb-4' style="height: 100px;">
            <div @click='room ? room.setIcon("-") : null' class="my-auto">
                <s-avatar class="my-auto" style="padding-right: 3px; border: 1px solid white;">
                    <dynamic-icon name="chevron" direction="left" typeGroup="settings"/>
                </s-avatar>
            </div>

            <div class="my-auto" style="width: 70px; height: 70px">
                <transition :name="room ? room.lastTransition : 'slide-left'">
                    <s-avatar :key="room ? room.class : 'softwareupdate'" :size="60" style="border: 1px solid white;">
                        <dynamic-icon :name="room ? room.getIcon() : 'softwareupdate'" :typeGroup="room ? 'rooms' : 'settings'"/>
                    </s-avatar>
                </transition>
            </div>

            <div @click='room ? room.setIcon("+")  : null' class="my-auto">
                <s-avatar class="my-auto" style="padding-left: 3px; border: 1px solid white;">
                    <dynamic-icon direction="right" name="chevron" typeGroup="settings"/>
                </s-avatar>
            </div>
        </div>

        <transition mode="out-in" name="fade">
            <div class='row d-flex justify-content-around' v-if="room">
                <div :key="scene.id" class="col-3 col-lg-2 col-xl-1 mb-4" v-for="scene in scenes">
                    <collapse-transition>
                        <scene :id='scene.id' :room-id='room.id'/>
                    </collapse-transition>
                </div>
            </div>

            <div class='row d-flex justify-content-around' v-else>
                <div :key="index" class="col-3 col-lg-2 col-xl-1 mb-4" v-for="index in 4">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-around">
                            <label class="scene">
                                <input disabled type="checkbox">
                                <div class="checkmark">
                                    <i class="el-icon-loading text-white" style="font-size: x-large; margin-top: 10px"/>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

        <div class="row d-flex mt-2 mt-lg-4 px-0 justify-content-between" v-if="room && lights">
            <div :class="{'shake' : light.shaking}" class="col-12 col-md-6 col-lg-4 col-xl-3 pl-0 my-2"
                 v-for="light in lights">
                <collapse-transition>
                    <hue-wrapper :id="light.id" type="lights" v-if='light' v-longclick="() => holdToRemove(light.id)"/>
                    <div :key="light.shaking" @click="swipe(light.id)" class="after" v-if="light.shaking"/>
                </collapse-transition>
            </div>
        </div>
    </overlay-page-template>
</template>

<script>
    import { putHue } from "Core/helpers/async";
    import componentWidthDynamicModule from 'Core/utils/componentWithDynamicModule';
    import Light from "Core/models/Light";

    const modules = ['rooms', 'scenes', 'lights'];

    export default {
        name: 'RoomDetail',
        extends: componentWidthDynamicModule(modules),
        components: {
            HueWrapper: () => import( /* webpackChunkName: "hue-wrapper-component" */ '../components/HueWrapper'),
            Scene: () => import( /* webpackChunkName: "hue-scene-component" */ '../components/Scene'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
            SAvatar: () => import( /* webpackChunkName: "icon-holder-component" */  'element-ui/lib/avatar'),
            ElDropdown: () => import( /* webpackChunkName: "dropdown-component" */  'element-ui/lib/dropdown'),
            ElDropdownMenu: () => import( /* webpackChunkName: "dropdown-menu-component" */  'element-ui/lib/dropdown-menu'),
            ElDropdownItem: () => import( /* webpackChunkName: "dropdown-item-component" */  'element-ui/lib/dropdown-item')
        },

        computed: {
            room: {
                get() {
                    return this.$store.state[modules[0]].items.find(item => item.id === +this.id);
                },
                set() {
                    return console.log('[SCHEPPER]: method not provided yet');
                }
            },

            scenes: {
                get() {
                    return this.$store.state[modules[1]].items;
                },
                set() {
                    return console.log('[SCHEPPER]: method not provided yet');
                }
            },

            lights: {
                get() {
                    let lights = [];
                    if (this.room)
                        this.room.lights.forEach(light => {
                            let lightObject = this.$store.state[modules[2]].items.find(item => item.id === +light);
                            lights.push(new Light(lightObject));
                        });

                    return lights;
                },
                set() {
                    return console.log('[SCHEPPER]: method not provided yet');
                }
            }
        },

        data() {
            return {
                id: this.$route.params.id,
                refresh: 0,
                refreshLights: 0
            }
        },

        async created() {
            await modules.forEach((module, index) => {
                return this.$store.dispatch(`${module}/initialize`, module);
            });
        },

        methods: {
            async save() {
                await putHue('rooms', this.id, {class: this.room.class}, false)
                    .then(async () => await this.$router.back());
            },

            async remove() {
                return await this.room.remove().then(async () => await this.$router.back());
                // await playSound('empty_trash')
            },

            holdToRemove(id) {
                // const index = this.lights.indexOf(id);
                // this.lights[index].shaking = !this.lights[index].shaking;
            },

            swipe(id) {
                this.lights.splice(this.lights.indexOf(id), 1)
            }
        },

        mounted() {
            this.refresh = setInterval(() => this.$store.dispatch(`${modules[1]}/fetch`, modules[1]), 15000);
            this.refreshLights = setInterval(() => this.$store.dispatch(`${modules[2]}/fetch`, modules[2]), 4000);
        },

        beforeDestroy() {
            clearInterval(this.refresh);
            clearInterval(this.refreshLights);
        }
    }
</script>
