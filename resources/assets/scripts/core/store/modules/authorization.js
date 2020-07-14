/*
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

import Vue from 'vue';
import User from "Core/models/User";

export default {
    namespaced: true,

    state() {
        return {
            authenticated: false,
            user: null,
            silent: true
        }
    },

    actions: {
        async signIn({commit, state}, credentials) {
            try {
                credentials.silent = state.silent;
                const mockCreds = {
                    email: 'levimbg@gmail.com',
                    name: 'levi',
                    password: 'admin',
                    password_confirmation: 'admin'
                }
                return await Vue.axios.post('auth/login', mockCreds).then(response => {
                    commit('SET_USER', new User(response.data.user));
                });
            } catch (e) {
                throw e;
            }
        },

        async signOut({commit}) {
            await Vue.axios.post('auth/logout').then(() => commit('SET_USER', null));
        },

        async setAuth({commit}, user) {
            commit('SET_USER', new User(user));
        },

        async toggleSilent({commit}, value) {
            commit('SET_SILENT', value);
        }
    },

    mutations: {
        SET_SILENT(state, value) {
            state.silent = value;

            if (state.user)
                state.user.preferences.silent = value;
        },

        SET_USER(state, value) {
            if (value) {
                state.silent = value.preferences.silent;
                state.authenticated = true;
            } else {
                state.silent = false;
                state.authenticated = false;
            }

            state.user = value;
            Vue.prototype.$user = new User(state.user);
        },

    },

    getters: {
        authenticated: state => state.authenticated,
        user: state => state.user,
        silent: state => state.silent,
        authStatus: state => state.status

    }
}
