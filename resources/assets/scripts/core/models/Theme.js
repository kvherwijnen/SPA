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

export default class Theme {
    constructor(data = {}) {
        this.id = data.id;
        this.name = data.name;
        this.primary = data.primary;
        this.secondary = data.secondary;
        this.text = data.text;
        this.background = data.background;
    }

    /**
     * Update a Theme
     *
     * @returns {Promise<boolean>}
     */
    async update() {
        try {
            await axios.put('themes/' + this.id, this);
        } catch (e) {
            throw e;
        }
    }

    /**
     * Create a Theme
     *
     * @returns {Promise<boolean>}
     */
    async create() {
        try {
            await axios.post('themes', this);
        } catch (e) {
            throw e;
        }
    }
}
