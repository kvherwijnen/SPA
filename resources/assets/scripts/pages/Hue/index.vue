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
    <static-page-template>
        <h1 class="h1-seo">Hue Landing page</h1>
        <div v-if="loading" class="loading">
            <dynamic-icon name="settings" typeGroup="settings" class='spinner-grow' :size="300"/>
        </div>
        <router-view name="/hue/users" v-else/>
    </static-page-template>
</template>

<script>
    export default {
        data () {
            return {
                loading: true,
                post: null,
                error: null
            }
        },
        created () {
            // fetch the data when the view is created and the data is
            // already being observed
            this.fetchData()
        },
        watch: {
            // call again the method if the route changes
            '$route': 'fetchData'
        },
        methods: {
            fetchData() {
                console.log('fetching niffo')
                return setTimeout(() => this.loading = false, 3000);
            }
        }
    }
</script>
