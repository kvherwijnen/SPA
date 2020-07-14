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
    <svg height="100%" viewBox="0 0 34 18" width="100%" xmlns="http://www.w3.org/2000/svg">
        <text fill="white" lengthAdjust="spacing" textLength="20" x="8" y="14">
            {{ getInitials() }}
        </text>
    </svg>
</template>

<script>
    import { mapGetters } from "vuex";
    import User from "Core/models/User";

    export default {
        name: 'UserInitials',
        props: {
            onlyFirst: {
                type: Boolean,
                default: false
            },
            user: {
                default: null,
                required: false
            }
        },
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                fallBackUser: 'auth/user',
            })
        },
        methods: {
            getInitials() {
                let user = this.fallBackUser;
                if (this.user) user = new User(this.user);
                let hasName = this.onlyFirst ? (user.firstName.length > 1) : (user.firstName.length > 1 && user.lastName.length > 1);

                if (hasName)
                    return user.firstName.substring(0, 1).toUpperCase() + (this.onlyFirst ? '' : (user.lastName.substring(0, 1).toUpperCase()));
                else
                    return user.name;
            }
        }
    }
</script>
