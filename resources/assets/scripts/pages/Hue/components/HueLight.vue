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
    <transition name="slide-left" type="out-in">
        <button :class="{ 'checked': checked }" @click="add" class="btn-hue-light">
            <div :class="{ 'box-checked': checked }" class="box"></div>
            <div :style="{ background: lightGradient }" class='hue-container'>
                <div class="hue">
                    <div class="hue-top">
                        <dynamic-icon :name="'error'" class="hue-top-reachable" typeGroup='settings' :color="'#ff8d72'"  v-if="!object.state.reachable"/>

                        <div v-else></div>
                        <dynamic-icon :name="object.getIcon()" typeGroup='lights' class="hue-top-icon" color="#2a2a2a"/>
                    </div>

                    <div class="hue-text hue-text-name" style="color: #2a2a2a" v-text="item.name"/>
                </div>
            </div>
        </button>
    </transition>
</template>

<script>
    import Light from "Core/models/Light";

    export default {
        name: "HueLight",
        props: {
            item: {
                required: true,
            }
        },

        data() {
            return {
                object: new Light(this.item),
                checked: false,
                rgb: null,
                lightGradient: 'linear-gradient(120deg, rgb(235, 141, 92) 0%, rgba(255, 201, 92) 100%)'
            }
        },

        methods: {
            add() {
                return this.checked = !this.checked;
            }
        }
    }
</script>
