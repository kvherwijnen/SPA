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

import register from './register';

export default (input) => {
    return {
        created() {
            if (Array.isArray(input))
                input.forEach(name => this.createOrGetModuleByName(name));

            else
                this.createOrGetModuleByName(input);
        },

        methods: {
            createOrGetModuleByName(name) {
                const store = this.$store;

                if (!(store && store.state && store.state[name])) 
                register(name, store);
                
            }
        }
    }
}
