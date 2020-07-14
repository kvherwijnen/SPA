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


import { mapGetters } from "vuex";

export default () => {
    require('Sounds/empty_trash.mp3');
    require('Sounds/payment_success.mp3');
    require('Sounds/photo.mp3');

    return {
        computed: mapGetters({silent: "auth/silent"}),

        methods: {
            async playSound(filename) {
                if (!this.silent)
                    return new Audio(`./assets/sounds/${filename}.mp3`).play();
            }
        }
    }
}
