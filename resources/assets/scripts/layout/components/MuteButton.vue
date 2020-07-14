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
    <vs-switch :value="silent" @click="toggle" :color="$user ? $user.preferences.theme.primary : '#fe4558'" plain>
        <template #off>
            <dynamic-icon name="bell" :size='18' color="#2a2a2a" typeGroup='settings'/>
        </template>

        <template #on>
            <dynamic-icon name="bell-slash" :size='18'  color="#2a2a2a" typeGroup='settings'/>
        </template>
    </vs-switch>
</template>

<script>
    import { mapActions, mapGetters } from "vuex";

    export default {
        name: 'MuteButton',
        components: {
            vsSwitch: () => import( /* webpackChunkName: "vs-switch-component" */ 'vuesax/dist/vsSwitch'),
        },

        computed: mapGetters({silent: "auth/silent"}),

        methods: {
            ...mapActions({toggleSilent: "auth/toggleSilent"}),

            async toggle() {
                let newSilent = !this.silent;

                if (this.user)
                    await axios.put('users/' + this.user.id, {silent: newSilent})
                        .then(async () => await this.toggleSilent(newSilent));
                else
                    await this.toggleSilent(newSilent);
            }
        }
    }
</script>

