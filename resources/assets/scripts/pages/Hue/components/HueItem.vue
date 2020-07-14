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
    <hue-wrapper :id='id' :type="type" v-if="id"/>
</template>

<script>
    export default {
        name: "HueItem",
        props: {
            id: {
                required: true
            },
            type: {
                type: String,
                required: true
            }
        },

        components: {
            HueWrapper: () => import( /* webpackChunkName: "hue-wrapper-component" */ './HueWrapper')
        }
    }
</script>
