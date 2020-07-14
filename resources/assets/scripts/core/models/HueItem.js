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

import { removeHue } from "../helpers/async";

export default class HueItem {
    constructor(data) {
        this.name = data.name;
    }

    /**
     * Remove this Hue instance
     *
     * @returns {Promise<boolean>}
     */
    // async remove() {
    //     return await removeHue(this.type, this.id);
    // }
}
