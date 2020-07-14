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
    <div class="bar-item">
        <div class="container d-flex justify-content-between p-0">
            <div class="d-flex">
                <div class="d-inline-block">
                    <dynamic-icon :name="icon" :color='color' :typeGroup="type || 'settings'" class="mr-2"/>

                    <slot name="name">
                        Instellingen
                    </slot>
                </div>
            </div>

            <div class="my-auto">
                <div class="d-inline-block my-auto mr-2">
                    <slot name="text-right">
                        <!--  Optional extra text   -->
                    </slot>
                </div>

                <span class="mr-2">
                    <slot name="right">
                        <dynamic-icon :color="'#656565'" name="chevron" direction="right" typeGroup="settings" class="mr-2"/>
                    </slot>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Bar',
        props: {
            color: {
                type: String,
                default: '#FFFFFF'
            },
            type: { type: String, default: 'settings' },
            icon: {
                type: String,
                default: 'error'
            }
        }
    }
</script>
