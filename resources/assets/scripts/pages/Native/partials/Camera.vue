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
    <div class="camera-wrapper">
        <div class="d-flex justify-content-between camera-header">
            <button @click="back" class="footer-button camera-footer-item l">
                <dynamic-icon name="chevron" typeGroup="settings"/>
            </button>

            <span class="my-auto">
                <router-link to="/">
                    <strong>Artificial</strong>Intelligence
                </router-link>
            </span>

            <button :disabled="!options[1]" @click="changeCamera" class="footer-button camera-footer-item r">
                <dynamic-icon name="exchange" :color="options[1] ? '#ffffff' : '#ffffff60'" typeGroup="settings"/>
            </button>
        </div>

        <canvas :class="filters[filterIndex] + ' filter-transition'" v-show="!cameraState"/>
        <video :class="filters[filterIndex] + ' filter-transition'" autoplay playsinline v-show="cameraState"/>

        <div class="d-flex justify-content-between camera-footer">
            <button @click="changeEffect" class="footer-button camera-footer-item l">
                <dynamic-icon name="magic-wand" typeGroup="settings"/>
            </button>

            <button :disabled="isStartEnabled || !options[0]" @click="snapshot" class="camera-button camera-footer-item"
                    v-if="cameraState" :class="{disabled: !options[0]}"/>
            <button :disabled="isStartEnabled || !options[0]" @click="start" class="camera-button camera-footer-item capture"
                    v-if="!cameraState"  :class="{disabled: !options[0]}"/>

            <button class="footer-button camera-header-item r">
                <router-link to="/gallery">
                    <dynamic-icon name="images" typeGroup="settings"/>
                </router-link>
            </button>
        </div>
    </div>
</template>

<script>
    import playSound from "Core/helpers/playSound";
    import BackButton from "GlobalComponents/PageHeader/BackButton";

    export default {
        name: "Camera",
        extends: playSound(),
        components: {
            BackButton
        },

        data() {
            return {
                video: null,
                canvas: null,
                isStartEnabled: true,
                stream: null,
                currentStream: null,
                devices: [],
                options: [],
                constraints: {},
                selectedDevice: null,
                cameraState: true,
                filterIndex: 0,
                filters: [
                    '',
                    'grayscale',
                    'sepia',
                    'blur',
                    'brightness',
                    'contrast',
                    'hue-rotate',
                    'hue-rotate2',
                    'hue-rotate3',
                    'saturate',
                    'invert'
                ]
            };
        },

        methods: {
            async back() {
                try {
                    if(window.history.length > 1)
                        await this.$router.go(-1);
                    else
                        await this.$router.push('/');
                } catch (e) {
                    throw e; // TODO: Make error callback like a toast or alert
                }
            },
            snapshot() {
                this.playSound('photo');

                this.canvas.width = this.video.videoWidth;
                this.canvas.height = this.video.videoHeight;
                this.canvas.getContext("2d")
                    .drawImage(this.video, 0, 0, this.canvas.width, this.canvas.height);
                this.cameraState = false;
            },
            stop() {
                this.video.pause();
                if (this.currentStream) {
                    this.currentStream.getTracks().forEach(track => track.stop());
                    this.video.srcObject = null;
                }

                this.video.removeAttribute("src");
                this.video.load();
                this.filterIndex = 0;
                this.canvas.getContext("2d")
                    .clearRect(0, 0, this.canvas.width, this.canvas.height);
                this.cameraState = false;
            },
            start() {
                this.stop();

                this.selectedDevice = this.options[0].value;
                this.getMedia().then(() => {
                    this.isStartEnabled = false;
                    this.cameraState = true;
                });
            },

            getMedia: async function () {
                try {
                    if(process.env.NODE_ENV === 'production') {
                        this.stream = await navigator.mediaDevices.getUserMedia(
                            this.constraints
                        );
                        window.stream = this.stream;
                        this.currentStream = window.stream;
                        this.video.srcObject = window.stream;
                        this.setConstraints();
                        return true;
                    }
                    return false;
                } catch (err) {
                    throw err;
                }
            },
            changeCamera() {
                if (this.options[1] || this.options[1] !== null) {
                    this.stop();

                    if (this.selectedDevice === this.options[0].value)
                        this.selectedDevice = this.options[1].value;
                    else
                        this.selectedDevice = this.options[0].value;

                    this.setConstraints();
                    this.getMedia().then(result => {
                        this.isStartEnabled = false;
                        this.cameraState = true;
                    });
                }
            },
            changeEffect() {
                const filterLength = (this.filters.length - 1);
                let filter = this.filterIndex + 1;

                if (filterLength <= this.filterIndex)
                    filter = 0;

                return this.filterIndex = filter;
            },
            setConstraints: function () {
                const videoConstraints = {};

                if (this.selectedDevice === null) {
                    videoConstraints.facingMode = "environment";
                } else {
                    videoConstraints.deviceId = {exact: this.selectedDevice};
                }

                this.constraints = {
                    video: videoConstraints,
                    audio: false
                };
            },

            async getDevices() {
                if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices)
                    return false;

                try {
                    let allDevices = await navigator.mediaDevices.enumerateDevices();
                    for (let mediaDevice of allDevices) {
                        if (mediaDevice.kind === "videoinput") {
                            let option = {};
                            option.text = mediaDevice.label;
                            option.value = mediaDevice.deviceId;
                            this.options.push(option);
                            this.devices.push(mediaDevice);
                        }
                    }
                    return true;
                } catch (err) {
                    throw err;
                }
            }
        },
        mounted() {
            this.canvas = document.querySelector("canvas");
            this.video = document.querySelector("video");
            this.getDevices()
                .then(res => {
                    //when first loaded selected device can use 1st option
                    this.selectedDevice = this.options[0].value;
                    this.setConstraints();
                }).then(() => this.getMedia().then(res => this.isStartEnabled = false));
        },
        beforeDestroy() {
            this.stop();
        }
    }
</script>
