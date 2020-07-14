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
        <button :disabled="!hueObject.state.reachable" class="btn-hue">
            <div :class="{'is-dragging': dragging, 'shake' : shaking}"
                 :key='shaking' :style="{ background: isChecked ? BackgroundColor : 'rgba(35,35,35,0.84)' }"
                 @click="shaking ? remove() : ''" class="hue-container">
                <div class="hue">
                    <div class="hue-content">
                        <router-link :to="type === 'rooms' ? '/hue/rooms/'+ id : ''" class="hue-content-icon">
                            <dynamic-icon :name="hueObject.getIcon()" :typeGroup='type' :color="isChecked ? FontColor : '#FFFFFF'"/>
                        </router-link>

                        <router-link :to="type === 'rooms' ? '/hue/rooms/'+ id : ''" class="hue-content-text">
                            <div :style="{ color: isChecked ? FontColor : '#FFFFFF'}" class="hue-content-text-name">
                                <span class="d-block" v-text="hueObject.name"/>

                                <small class="d-block font-weight-600 reachable"
                                       v-if="!hueObject.state.reachable" v-text="'Niet bereikbaar'"/>
                                <span :style="{color: isChecked ?  (FontColor === '#FFFFFF' ? 'rgba(255, 255, 255, 0.5)' : 'rgba(5,5,5,0.7)') : 'rgba(255, 255, 255, 0.5)'}"
                                      class="d-block small font-weight-600"
                                      v-else>
                                    {{ dragging ? value + '%' : ((type === 'rooms') ? ('Alle lampen staan ' + (isChecked ? 'aan' : 'uit')) : '') }}
                                </span>
                            </div>
                        </router-link>

                        <toggle :checked="isChecked" :disabled="!hueObject.state.reachable" :hex-color="hexColor"
                                :id='id'/>
                    </div>
                </div>

                <collapse-transition>
                    <slider :background-color="BackgroundColor" :disabled="!hueObject.state.reachable"
                            :is-visible="isChecked" :value="value"
                            @change="handleChange"
                            @dragging="handleDragging" v-if="isChecked"/>
                </collapse-transition>
            </div>
        </button>
    </transition>
</template>

<script>
    import Color from "color";
    import Gradient from 'tinygradient';
    import { mapState } from "vuex";

    export default {
        name: "HueWrapper",
        components: {
            Slider: () => import( /* webpackChunkName: "hue-slider" */  './partials/Slider'),
            Toggle: () => import( /* webpackChunkName: "hue-toggle" */  './partials/Toggle')
        },

        props: {
            id: {
                required: true
            },
            type: {
                type: String,
                default: 'rooms'
            }
        },

        data() {
            return {
                dragging: false,
                isChecked: false,
                value: 0,
                shaking: false
            }
        },

        computed: {
        ...mapState(name, {items: state => state.items}),

            hueObject: {
                get() {
                    const object = this.$store.state[this.type].items.find(item => {
                        return item.id === +this.id
                    });
                    this.isChecked = this.type === 'lights' ? object.state.on : object.state.any_on;
                    this.value = (object[this.type === 'lights' ? 'state' : 'action'].bri / 254) * 100;

                    return object;
                },
                set(value) {
                    this.$store.dispatch(this.type + '/update', value);
                    this.isChecked = this.type === 'lights' ? object.state.on : object.state.any_on;
                    this.value = (object[this.type === 'lights' ? 'state' : 'action'].bri / 254) * 100;
                }
            },

            /**
             * @return {string}
             */
            hexColor() {
                if (this.type !== 'rooms' && !this.isChecked || this.type === 'rooms' && !this.isChecked || this.type === 'rooms' && !(this.hueObject.lights.length >= 2))
                    return ["#ffdc69", '#fde8bd'];

                else {
                    let state;
                    if (this.hueObject.state.xy)
                        state = this.hueObject.state;
                    else if (this.hueObject.action && this.hueObject.action.xy)
                        state = this.hueObject.action;
                    else return ["#ffdc69", '#fde8bd'];

                    const x = state.xy[0]; // the given x value
                    const y = state.xy[1]; // the given y value
                    const z = 1.0 - x - y;
                    const Y = state.bri; // The given brightness value
                    const X = (Y / y) * x;
                    const Z = (Y / y) * z;
                    const red1 = X * 1.656492 - Y * 0.354851 - Z * 0.255038;
                    const green1 = -X * 0.707196 + Y * 1.655397 + Z * 0.036152;
                    const blue1 = X * 0.051713 - Y * 0.121364 + Z * 1.011530;
                    const red2 = (red1 <= 0.0031308 ? 12.92 * red1 : (1.0 + 0.055) * Math.pow(red1, (1.0 / 2.4)) - 0.055);
                    const green2 = (green1 <= 0.0031308 ? 12.92 * green1 : (1.0 + 0.055) * Math.pow(green1, (1.0 / 2.4)) - 0.055);
                    const blue2 = (blue1 <= 0.0031308 ? 12.92 * blue1 : (1.0 + 0.055) * Math.pow(blue1, (1.0 / 2.4)) - 0.055);
                    const correction = Math.max(red2, green2, blue2);
                    const red = Math.floor(Math.max(red2 / correction, 0) * 255);
                    const green = Math.floor(Math.max(green2 / correction, 0) * 255);
                    const blue = Math.floor(Math.max(blue2 / correction, 0) * 255);
                    const first = "#" + red.toString(16).padStart(2, "0") +
                        green.toString(16).padStart(2, "0") +
                        blue.toString(16).padStart(2, "0");
                    const second = (first + "80");

                    return [first, second];
                }
            },

            /**
             * @return {string}
             */
            BackgroundColor() {
                if (Array.isArray(this.hexColor)) {
                    if (this.hexColor.length < 2)
                        return this.hexColor[0];

                    return Gradient(this.hexColor).css("linear");
                } else if (this.type === 'lights') {

                }
                return this.hexColor;
            },

            /**
             * @return {string}
             */
            FontColor() {
                let color = this.hexColor;
                if (Array.isArray(this.hexColor)) {
                    color = this.hexColor[0];
                }
                return Color(color).isLight() ? '#2a2a2a' : '#FFFFFF';
            }
        },

        methods: {
            async changeState(brightness) {
                await this.hueObject.update({bri: brightness});
            },

            handleChange(value) {
                this.value = value;
                this.$emit("change", this.id, value);
            },

            async handleDragging(value) {
                this.dragging = value;

                if (!this.dragging) {
                    const val = Math.round((this.value / 100) * 254);
                    await this.changeState(val);
                }
            },

            Color,
            setColor() {
                const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e.target.value);
                const red = parseInt(result[1], 16) / 255;
                const green = parseInt(result[2], 16) / 255;
                const blue = parseInt(result[3], 16) / 255;
                const red2 = (red > 0.04045) ? Math.pow((red + 0.055) / (1.0 + 0.055), 2.4) : (red / 12.92);
                const green2 = (green > 0.04045) ? Math.pow((green + 0.055) / (1.0 + 0.055), 2.4) : (green / 12.92);
                const blue2 = (blue > 0.04045) ? Math.pow((blue + 0.055) / (1.0 + 0.055), 2.4) : (blue / 12.92);
                const X = red2 * 0.664511 + green2 * 0.154324 + blue2 * 0.162028;
                const Y = red2 * 0.283881 + green2 * 0.668433 + blue2 * 0.047685;
                const Z = red2 * 0.000088 + green2 * 0.072310 + blue2 * 0.986039;
                const x = X / (X + Y + Z);
                const y = Y / (X + Y + Z);
                return this.hexColor = [x, y];
            },

            tapToRemove() {
                if (this.type === 'lights')
                    return this.shaking = true;
            },

            remove() {
                console.log('remove')
            }
        }
    }
</script>
