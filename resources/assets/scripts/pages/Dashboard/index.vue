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
        <div class="row d-flex px-0 justify-content-start">
            <div class="col-4 col-md-3 col-xl-2 pl-0">
                <vs-button animation-type="vertical" class="btn-block border-dashed" :color="$user.preferences.theme.primary" gradient to="/store">
                    <dynamic-icon name="plus" class="my-2" typeGroup='settings'/>

                    <template #animate>
                        <h5 class="mb-0">Store</h5>
                    </template>
                </vs-button>
            </div>

            <div class="col-4 col-md-3 col-xl-2 pl-0" v-if="$user.preferences.hue_installed">
                <vs-button animation-type="vertical" class="btn-block" :color="$user.preferences.theme.primary" gradient to="/hue/rooms">
                    <dynamic-icon name="sheep" class="my-2" typeGroup='settings'/>
                    <template #animate>
                        <h5 class="mb-0">Hue</h5>
                    </template>
                </vs-button>
            </div>

            <div class="col-4 col-md-3 col-xl-2 pl-0" v-if="$user.preferences.hue_installed">
                <vs-button animation-type="vertical" class="btn-block" :color="$user.preferences.theme.primary" gradient to="/settings">
                    <dynamic-icon name="digg" class="my-2" typeGroup='settings'/>
                    <template #animate>
                        <h5 class="mb-0">Logout</h5>
                    </template>
                </vs-button>
            </div>
        </div>
    </static-page-template>
</template>

<script>
    export default {
        name: 'Dashboard',
        components: {
            vsButton: () => import( /* webpackChunkName: "vs-button-component" */ 'vuesax/dist/vsButton'),
        }
    }
</script>
