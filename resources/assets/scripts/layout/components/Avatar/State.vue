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
    <vs-avatar :badge-color="badgeColor" :size="size.toString()" badge badge-position="bottom-left" history
               history-gradient>
        <g-image :email="mail" :size='size + 100' :user='user'/>
    </vs-avatar>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        name: 'State',
        props: {
            email: {
                type: String,
                required: false
            },
            user: {
                default: null,
                required: false
            },
            size: {
                type: Number,
                default: 40
            }
        },

        computed: {
            badgeColor() {
                return this.user.preferences.silent ? 'danger' : 'success';
            }
        },

        data() {
            return {
                mail: this.email
            }
        },

        mounted() {
            if (this.user)
                this.mail = this.user.email
        },

        components: {
            vsAvatar: () => import( /* webpackChunkName: "vs-avatar-component" */ 'vuesax/dist/vsAvatar'),
            GImage: () => import(  /* webpackChunkName: "gravatar-image-component" */  './GImage')
        }
    }
</script>
