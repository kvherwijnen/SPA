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
    <!--    Below a fallback when Gravatar response is 404    -->
    <user-initials :only-first='false' :user='user' v-if="error"/>
    <img :email="email" :src="url" @error="onError" @load="onLoad" alt="" v-bind="attrs" v-else v-on="listeners"/>
</template>

<script>
    import md5 from "md5";

    export default {
        name: 'GImage',
        inheritAttrs: false,
        props: {
            email: {
                type: String,
                default: ''
            },
            hash: {
                type: String,
                default: ''
            },
            size: {
                type: Number,
                default: 40
            },
            defaultImg: {
                type: String,
                default: '404'
            },
            rating: {
                type: String,
                default: 'g'
            },
            protocol: {
                type: String,
                default: ''
            },
            user: {
                default: null,
                required: false
            }
        },
        computed: {
            url() {
                const protocol = this.protocol.slice(-1) === ':'
                    ? this.protocol
                    : `${this.protocol}:`;
                const img = [
                    `${protocol === ':' ? '' : protocol}//www.gravatar.com/avatar/`,
                    this.hash || md5(this.email.trim().toLowerCase()),
                    `?s=${this.size}`,
                    `&d=${this.defaultImg}`,
                    `&r=${this.rating}`
                ];
                return img.join('');
            },
            listeners() {
                const {load, error, ...listeners} = this.$listeners;
                return listeners;
            },
            attrs() {
                const {src, alt, ...attrs} = this.$attrs;
                return attrs;
            }
        },
        data() {
            return {
                error: false
            }
        },
        components: {
            UserInitials: () => import( /* webpackChunkName: "user-initials-component" */ './UserInitials')
        },
        methods: {
            onLoad(...args) {
                this.$emit('load', ...args);
            },
            onError() {
                this.error = true
            }
        }
    }
</script>
