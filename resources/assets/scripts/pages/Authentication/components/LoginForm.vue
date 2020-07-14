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
    <s-form :model="credentials" :rules="rules" @keyup.enter="submit" name='login' ref="login">
        <div class='text-center' style="height: 45px">
            <collapse-transition>
                <div class="el-form__error" v-show="error">
                    <span class="el el-icon-error text-danger"/>
                    <span class='text-danger' v-text="error"/>
                </div>
            </collapse-transition>
        </div>

        <form-item>
            <mute-button/>
        </form-item>

        <form-item :class="error ? 'is-error' : ' '" prop="name">
            <input-text @keyup.enter="submit" clearable
                        placeholder="Gebruikersnaam" type="text" v-model="credentials.name"/>
        </form-item>

        <form-item :class="error ? 'is-error' : ''" prop="password">
            <input-text @keyup.enter="submit" class="mb-3" placeholder="Wachtwoord" show-password
                        type="password" v-model="credentials.password"/>
        </form-item>

        <form-item>
            <s-button :loading="loading" @click="submit" class="btn btn-block btn-outline-white">
                Inloggen
            </s-button>
        </form-item>
    </s-form>
</template>

<script>
    import { mapActions } from "vuex";
    import { validateUsername, validatePassword } from "Core/helpers";
    import playSound from "Core/helpers/playSound";

    export default {
        name: 'LoginForm',
        extends: playSound(),

        components: {
            MuteButton: () => import( /* webpackChunkName: "mute-button-component" */  'GlobalComponents/MuteButton'),
            SForm: () => import( /* webpackChunkName: "form-component" */ 'element-ui/lib/form'),
            FormItem: () => import( /* webpackChunkName: "form-item-component" */ 'element-ui/lib/form-item'),
            SButton: () => import( /* webpackChunkName: "button-component" */  'element-ui/lib/button'),
            InputText: () => import( /* webpackChunkName: "input-component" */  'element-ui/lib/input')
        },

        data() {
            return {
                error: null,
                loading: false,
                credentials: {
                    name: '',
                    password: ''
                },
                rules: {
                    name: [{validator: validateUsername, trigger: 'blur'}],
                    password: [{validator: validatePassword, trigger: 'blur'}]
                }
            }
        },

        methods: {
            ...mapActions({signIn: 'auth/signIn'}),

            async submit() {
                return await this.$refs['login'].validate(async (valid) => {
                    if (valid) {
                        this.loading = true;
                        try {
                            await this.signIn(this.credentials).then(async () => this.playSound('payment_success'));
                        } catch (e) {
                            return this.error = 'De ingevulde gegevens kloppen niet';
                        }
                    }
                });
            }
        }
    }
</script>
