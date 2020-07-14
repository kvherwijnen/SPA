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
    <s-form :model="credentials" :rules="rules" name='register' ref="register">
        <div style="height: 45px">
            <collapse-transition>
                <div class="el-form__error" v-show="error">
                    <span class="el el-icon-error text-danger"></span>
                    <span class='text-danger'> {{error}} </span>
                </div>
            </collapse-transition>
        </div>

        <form-item :class="error ? 'is-error' : ' '" prop="name">
            <input-text clearable placeholder="Gebruikersnaam" tabindex="1"
                        type="text" v-model="credentials.name">
                <template slot="prepend">
                    <i class="fas fa-user"></i>
                </template>
            </input-text>
        </form-item>

        <form-item :class="error ? 'is-error' : ' '" prop="email">
            <input-text clearable placeholder="E-mailadres" tabindex="2"
                        type="email" v-model="credentials.email">
                <template slot="prepend">
                    <i class="far fa-at"></i>
                </template>
            </input-text>
        </form-item>

        <form-item :class="error ? 'is-error' : ''" prop="password">
            <input-text @keyup.enter="submit" placeholder="Wachtwoord" show-password tabindex="3"
                        type="password" v-model="credentials.password">
                <template slot="prepend"><i class="fas fa-lock"></i></template>
            </input-text>
        </form-item>

        <form-item>
            <s-button :loading="loading" @click="submit" class="btn-block btn-outline-primary mt-3"
                      tabindex="5" type="primary">
                Meld mij aan!
            </s-button>
        </form-item>
    </s-form>
</template>

<script>
    import { validatePassword } from "Core/helpers";

    export default {
        name: 'RegisterForm',
        components: {

            SForm: () => import( /* webpackChunkName: "form-component" */ 'element-ui/lib/form'),
            FormItem: () => import( /* webpackChunkName: "form-item-component" */ 'element-ui/lib/form-item'),
            SButton: () => import( /* webpackChunkName: "button-component" */  'element-ui/lib/button'),
            ButtonGroup: () => import( /* webpackChunkName: "button-group-component" */  'element-ui/lib/button'),
            InputText: () => import( /* webpackChunkName: "input-component" */  'element-ui/lib/input'),
        },
        data() {
            return {
                error: null,
                loading: false,
                credentials: {
                    name: '',
                    email: '',
                    password: ''
                },
                rules: {
                    // name: [{validator: validateName, trigger: 'blur'}],
                    // email: [{validator: validateEmail, trigger: 'blur'}],
                    password: [{validator: validatePassword, trigger: 'blur'}]
                }
            }
        },
        methods: {
            submit() {
                this.loading = true;

                this.$refs['register'].validate((valid) => {
                    if (valid) {
                        this.$auth.register({
                            body: this.credentials, // Vue-resource
                            data: this.credentials, // Axios
                            refresh: true,
                        }).then(response => {
                            // TODO: Add welcome
                            setTimeout(() => {
                                this.loading = false;
                                return true;
                            }, 1000);
                        }).catch(e => {
                            setTimeout(() => {
                                this.loading = false;
                                this.error = 'De gegevens die je hebt ingevuld kloppen niet ' + e;
                                return false
                            }, 700);
                        });
                    } else {
                        this.loading = false;
                        return false;
                    }
                });
            }
        }
    }
</script>
