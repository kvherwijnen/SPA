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

import Theme from './Theme';

export default class Preferences {
    constructor(data = {}) {
        this.id = data.id;
        this.dark_mode = data.dark_mode || true;
        this.silent = data.silent;
        this.theme = new Theme(data.theme);
        this.hue_installed = data.hue_installed || false;
    }

    /**
     * Update users active theme
     *
     * @param {Number} id
     * @returns {Promise<boolean>}
     */
    async updateTheme(id) {
        try {
            await axios.put('preferences/' + this.id, {theme: id}).then(response => this.theme = response.data.theme);
        } catch (e) {
            throw e; // TODO: return toast or alert with error
        }
     }
}
