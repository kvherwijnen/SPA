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
    <transition name="slide-up">
        <div class="network-alert" v-if="showBackOnline">
            <div :class="'content content-' + (onLine ? 'connected' : 'disconnected')"
                 v-text="onLine ? 'Verbonden' : 'Je bent offline gegaan!'"/>
        </div>
    </transition>
</template>

<script>
    export default {
        name: 'NetworkAlert',

        data() {
            return {
                onLine: navigator.onLine,
                showBackOnline: false
            }
        },

        watch: {
            onLine(v) {
                this.showBackOnline = true;
                setTimeout(() => {
                    this.showBackOnline = false;
                }, 4500);
            }
        },

        async created() {
            window.addEventListener('online', this.updateOnlineStatus);
            window.addEventListener('offline', this.updateOnlineStatus);
        },

        methods: {
            updateOnlineStatus(e) {
                const {type} = e;
                this.onLine = type === 'online';
            }
        }
    }
</script>
