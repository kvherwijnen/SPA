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
    <el-avatar :size='size'
               style="box-shadow: 0 3px 6px rgba(0,0,0,.20),0 3px 6px rgba(0,0,0,.32); background-color: rgba(29,45,128,0.76)">
        <g-image :email="mail" :size='size' :user='user'/>
    </el-avatar>
</template>

<script>
    export default {
        name: 'SAvatar',
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
            ElAvatar: () => import( /* webpackChunkName: "s-avatar-component" */ 'element-ui/lib/avatar'),
            GImage: () => import(  /* webpackChunkName: "gravatar-image-component" */  './GImage')
        }
    }
</script>
