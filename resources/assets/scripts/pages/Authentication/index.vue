<template>
    <static-page-template>
        <div class="d-flex flex-row justify-content-around h-100">
            <div :class="{'swipe-up': animated}" class="auth-wrapper my-auto">
                <div class="auth-logo">
                    <strong>Artificial</strong>Intelligence
                </div>

                <div class="auth-content">
                    <transition name="fade" type="out-in">
                        <login-form class="mb-3" v-show="showForm"/>
                    </transition>

                    <transition name="fade" type="out-in">
                        <div v-show="signinApple">
                            <h5 class="text-center my-4">
                                of
                            </h5>

                            <div id="appleid-signin">
                                <vs-button :loading="appleLoading" @click="signInWithApple" animation-type="scale"
                                           block class="m-0" danger
                                           gradient style="border-radius: 5px !important;">
                                    <dynamic-icon name="apple" :size="18" typeGroup="settings"/>
                                    <span class="ml-2 d-inline-block pt-1"
                                          style="font-size: 14px">
                                        Sign in with Apple
                                    </span>

                                    <template #animate>
                                        <dynamic-icon name="apple" :size="18" typeGroup="settings"/>
                                    </template>
                                </vs-button>
                            </div>
                        </div>
                    </transition>
                </div>

                <transition name="fade" type="out-in">
                    <div class="auth-footer text-center mt-4" v-show="signinApple">
                        &copy; 2020<br/>
                        {{ $companyName }} Inc.
                    </div>
                </transition>
            </div>
        </div>
    </static-page-template>
</template>

<script>
    export default {
        name: 'Authentication',

        components: {
            LoginForm: () => import( /* webpackChunkName: "login-form-component" */ './components/LoginForm'),
            vsButton: () => import( /* webpackChunkName: "vs-button-component" */ 'vuesax/dist/vsButton')
        },
        data() {
            return {
                typeLogin: true,
                animated: false,
                showForm: false,
                signinApple: false,
                appleLoading: false
            }
        },

        async mounted() {
            setTimeout(() => {
                this.animated = true;
                setTimeout(() => {
                    this.showForm = true;
                    setTimeout(() => this.signinApple = true, 100)
                }, 350)
            }, 225)
        },
        methods: {
            async signInWithApple() {
                this.appleLoading = true;
            }
        }
    }
</script>
