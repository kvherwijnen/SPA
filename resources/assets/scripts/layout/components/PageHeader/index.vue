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
    <div class="row d-flex justify-content-between page-title mb-3">
        <h1 class="mb-0 cursor-pointer">
            <s-back-button/>
        </h1>

        <h2 class="h1-seo mb-0 my-auto" v-text="title"/>

        <h1 class="mb-0 cursor-pointer">
            <slot name="right">
                <dynamic-icon :color="color" :name="icon"  class="mr-2"/>

            </slot>
        </h1>
    </div>
</template>

<script>
    import SBackButton from './BackButton';

    export default {
        name: 'PageHeader',
        components: {
            SBackButton
        },
        props: {
            title: {
                type: String,
                required: true
            },

            icon: {
                type: String,
                default: ''
            },
            color: {
                type: String,
                default: '!#'

            }
        }
    }
</script>
