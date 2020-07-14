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
        <page-header :title="scene.name ? scene.name : 'Nieuwe scene'">
            <span @click="create" class="mr-2">
                <dynamic-icon name="plus" typeGroup="settings"/>
            </span>
        </page-header>

        <div class='row d-flex justify-content-around mb-4' style="height: 100px;">
            <div @click='scene.setIcon("-")' class="my-auto">
                <s-avatar class="my-auto" style="padding-top: 3px; padding-right: 3px; border: 1px solid white;">
                    <dynamic-icon name="chevron" direction="left" class="hue-top-icon"/>
                </s-avatar>
            </div>

            <div class="my-auto" style="width: 70px; height: 70px">
                <transition :name="scene.lastTransition">
                    <s-avatar :key="scene.icon" :size="60" style="border: 1px solid white;">
                        <dynamic-icon :name="scene.getIcon()" typeGroup="scenes"/>
                    </s-avatar>
                </transition>
            </div>

            <div @click='scene.setIcon("+")' class="my-auto">
                <s-avatar class="my-auto" style="padding-top: 3px; padding-left: 3px; border: 1px solid white;">
                    <dynamic-icon direction="right" name="chevron"/>
                </s-avatar>
            </div>
        </div>

        <div class="row mb-4">
            <input-text class="bg-trerty" placeholder="Relax" v-model="scene.name"/>
        </div>

        <div class="row">
            <h3>Effectkeuze</h3>
        </div>

        <div class="row mb-4">
            <div class="card card-body">
                <h4>Lichtstatus</h4>

                <el-switch active-text="Aanzetten" class="mx-auto" inactive-color="#ff4949"
                           inactive-text="Uitzetten"
                           style="display: block" v-model="scene.on"/>
            </div>
        </div>

        <div class="row mb-4">
            <div class="card card-body">
                <h4>Brightness</h4>
                <input-number :max='254' :min='1' v-model="scene.bri"/>
            </div>
        </div>
    </overlay-page-template>
</template>

<script>
    import Scene from "Core/models/Scene";

    export default {
        name: 'Create',
        components: {
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
            InputText: () => import( /* webpackChunkName: "input-component" */  'element-ui/lib/input'),
            ElSwitch: () => import( /* webpackChunkName: "switch-component" */  'element-ui/lib/switch'),
            InputNumber: () => import( /* webpackChunkName: "number-component" */  'element-ui/lib/input-number'),
            SAvatar: () => import( /* webpackChunkName: "icon-holder-component" */  'element-ui/lib/avatar')
        },

        data() {
            return {
                scene: new Scene({
                    name: '',
                    on: false
                })
            }
        },

        methods: {
            async create() {
                await this.scene.create().then(async () => await this.$router.back());
            }
        }
    }
</script>
