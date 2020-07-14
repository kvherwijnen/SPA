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
    <svg id="spinner" xmlns="http://www.w3.org/2000/svg" viewBox="21.25 21.25 42.5 42.5">
        <circle class="vh-spinner spin" cx="42.5" cy="42.5" r="20" fill="none" stroke-width="2.5" stroke-dasharray="125.66370614359172" stroke-dashoffset="125.66370614359172"/>
    </svg>
</template>

<script>
    export default {
        name: 'Spinner',
        props: ['isLight'],
    };
</script>
