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
    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" :fill='color' :height="size" :width="size" focusable="false" role="img">
        <use v-bind="{'xlink:href': svgFullName}"/>
    </svg>
</template>

<script>
    export default {
        name: 'DynamicIcon',
        props: {
            name: {
                type: String,
                default: 'error'
            },
            typeGroup: {
                type: String,
                default: 'rooms'
            },
            size: {
                type: Number,
                default: 32
            },
            color: {
                type: String,
                default: '#FFFFFF'
            }
        },

        data() {
            return {
                type: this.typeGroup,
            }
        },

        computed: {
            svgFullName() {
                return `../../../assets/img/${this.type}.svg#${this.name}`;
            }
        }
    }
</script>
