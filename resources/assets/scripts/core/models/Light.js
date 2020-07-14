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

import { putHue } from "../helpers/async";

export default class Light {
    constructor(data = {}) {
        this.id = data.id || 0;
        this.name = data.name || "Foutmelding";
        this.state = data.state || {reachable: false};
        this.type = data.type || String;
        this.swUpdate = data.swupdate || Object;
        this.modelID = data.modelid || String;
        this.config = data.config;
        this.shaking = data.shaking || false;
        this.checked = data.checked || false;
        this.capabilities = data.capabilities;
        this.productName = data.productname || String;
        this.color = this.transformColor();
    }

    /**
     * Get the Icon for the resource
     *
     * @returns {String}
     */
    getIcon() {
        return this.config.archetype;
    }

    /**
     * Get HEX color of this light
     *
     * @return {string}
     */
    transformColor() {
            let state = this.state;
            const x = state.xy[0];           // the given x value
            const y = state.xy[1];           // the given y value
            const z = 1.0 - x - y;
            const Y = state.bri;             // The given brightness value
            const X = (Y / y) * x;
            const Z = (Y / y) * z;
            const red1 = X * 1.656492 - Y * 0.354851 - Z * 0.255038;
            const green1 = -X * 0.707196 + Y * 1.655397 + Z * 0.036152;
            const blue1 = X * 0.051713 - Y * 0.121364 + Z * 1.011530;

            const red2 = (red1 <= 0.0031308 ? 12.92 * red1 : (1.0 + 0.055) * Math.pow(red1, (1.0 / 2.4)) - 0.055);
            const green2 = (green1 <= 0.0031308 ? 12.92 * green1 : (1.0 + 0.055) * Math.pow(green1, (1.0 / 2.4)) - 0.055);
            const blue2 = (blue1 <= 0.0031308 ? 12.92 * blue1 : (1.0 + 0.055) * Math.pow(blue1, (1.0 / 2.4)) - 0.055);

            const correction = Math.max(red2, green2, blue2);

            const red = Math.floor(Math.max(red2 / correction, 0) * 255);
            const green = Math.floor(Math.max(green2 / correction, 0) * 255);
            const blue = Math.floor(Math.max(blue2 / correction, 0) * 255);

            return "#" + red.toString(16).padStart(2, "0") +
                green.toString(16).padStart(2, "0") +
                blue.toString(16).padStart(2, "0");
    }

    /**
     * Update this light instance
     *
     * @returns {Promise<boolean>}
     */
    async update(state) {
        try {
            return await putHue('lights', this.id, state).then(() => this.state = {...this.state, ...state});
        } catch (e) {
            throw e;
        }
    }
}
