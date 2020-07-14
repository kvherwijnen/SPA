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
    <overlay-page-template>
        <div class="flex-center position-ref full-height">
            <div class="code">404</div>

            <div class="message" style="padding: 10px;">Pagina niet gevonden</div>
        </div>
    </overlay-page-template>
</template>

<script>
    export default {
        name: "NotFound"
    }
</script>

<style lang="css" scoped>
    .position-ref {
        position: relative;
        color: #fff !important;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .full-height {
        height: 100%;
    }
    .code {
        border-right: 2px solid;
        font-size: 26px;
        padding: 0 15px 0 15px;
        text-align: center;
    }

    .message {
        font-size: 18px;
        text-align: center;
    }
</style>
