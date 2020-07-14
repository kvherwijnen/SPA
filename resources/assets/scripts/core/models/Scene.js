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

import { postHue, putHue } from "../helpers/async";
import { scenesMap } from "../../pages/Hue/components/icons/scenes";

export default class Scene {
    constructor(data = {}) {
        this.id = data.id;
        this.name = data.name;
        this.icon = data.icon || this.randomIcon();
        this.bri = data.bri;
        this.hue = data.hue;
        this.effect = data.effect;
        this.alert = data.alert;
        this.on = data.on;
        this.lastTransition = 'slide-left';
    }

    getIcon() {
        let I = this.icon.toLowerCase();
        return I.replace(/\s/g, '');
    }

    findIndex() {
        let i = 0;
        let index = 0;
        scenesMap.find((c) => {
            if (c === this.getIcon())
                return index = i;

            i++
        });

        return index;
    }

    /**
     * Set the Icon for the resource
     *
     * @param {String} type
     * @returns {Scene}
     */
    async setIcon(type) {
        this.lastTransition = (type === '+' ? 'slide-left' : 'slide-right');

        let i = this.findIndex();
        let newIndex = (type === '+' ? i + 1 : i - 1);
        if (newIndex === scenesMap.length)
            newIndex = 0;
        else if (newIndex === 0)
            newIndex = (scenesMap.length - 1);

        const upper = scenesMap[newIndex];

        return this.icon = upper[0].toUpperCase() + upper.slice(1);
    }

    /**
     * Set a scene to a group
     *
     * @param {Number} id
     * @returns {Promise<boolean>}
     */
    async setSceneToGroup(id) {
        const body = {
            bri: this.bri,
            hue: this.hue,
            effect: this.effect,
            alert: this.alert,
            on: this.on
        }
        return await putHue('scenes', id, body, false);
    }

    /**
     * Set a scene to a group
     *
     * @returns {Promise<boolean>}
     */
    async create() {
        return await postHue('scenes', this);
    }

    randomIcon() {
        const randomNumber = Math.random() * scenesMap.length;
        const upper = scenesMap[Math.round(randomNumber)];

        return this.icon = upper[0].toUpperCase() + upper.slice(1);
    }
}
