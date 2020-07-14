<template>
    <div class="camera-wrapper">
        <div class="d-flex justify-content-around h-100">
            <div class="text-center my-auto">
                <dynamic-icon :size="60" name="digg" typeGroup="settings"/>
                <span class="d-block mt-2 text-white">you next time!</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from "vuex";

    export default {
        name: 'Logout',
        async mounted() {
            return await this.logout()
        },

        methods: {
            ...mapActions({signOut: 'auth/signOut'}),

            async logout() {
                setTimeout(async () => {
                    this.$hueTypes.forEach(type => {
                        //     if (this.$store.hasModule(type))
                        this.$store.unregisterModule(type);
                    });
                    this.signOut().then(async () => await this.$router.push('/login'));
                })
            }
        }
    }
</script>
