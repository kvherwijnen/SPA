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
    <div class="navbar fixed-top bg-transparent">
        <div class="container d-flex justify-content-between">
            <router-link class="navbar-brand" to="/">
                <span>Artificial</span>Intelligence
            </router-link>

            <s-avatar :user="user" v-if="user"/>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        name: 'Header',
        components: {
            SAvatar: () => import( /* webpackChunkName: "s-avatar-component" */  'GlobalComponents/Avatar/State')
        },
        computed: mapGetters({user: 'auth/user'})
    }
</script>
