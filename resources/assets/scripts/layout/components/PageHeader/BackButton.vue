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
    <span @click="back" class="my-auto">
        <dynamic-icon name="chevron" direction="left" typeGroup="settings"/>
    </span>
</template>

<script>
    export default {
        name: 'BackButton',
        methods: {
            async back() {
                try {
                    if(window.history.length > 1)
                        await this.$router.go(-1);
                    else
                        await this.$router.push('/');
                } catch (e) {
                    // TODO: Make error callback like a toast or alert
                    throw e;
                }
            }
        }
    }
</script>
