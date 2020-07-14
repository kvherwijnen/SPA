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

import { groupsMap } from "../../pages/Hue/components/icons/groups";
import { putHue, removeHue } from "../helpers/async";

export default class Room {
    constructor(data = {}) {
        this.id = data.id;
        this.name = this.getName(data);
        this.lights = data.lights;
        this.sensors = data.sensors;
        this.state = this.getState(data);
        this.action = data.action || Object;
        this.type = data.type;
        this.class = data.class || data.icon || 'Error';
        this.lastTransition = 'slide-left';
    }

    getState(data) {
        let state = data.state ? data.state : {any_on: false, all_on: false};

        if (!state.reachable)
            state.reachable = true;

        return state;
    }

    getName(data) {
        if (data.name)
            return data.name;

        else
            return 'Foutmelding';
    }

    getIcon() {
        let I = this.class.toLowerCase();
        return I.replace(/\s/g, '-');
    }

    findIndex() {
        let i = 0;
        let index = 0;
        groupsMap.find((c) => {
            if (c === this.getIcon())
                return index = i;
            i++
        });

        return index;
    }

    /**
     * Remove this room instance
     *
     * @returns {Promise<boolean>}
     */
    async remove() {
        try {
            await removeHue('rooms', this.id);
        } catch (e) {
            throw e;
        }
    }

    /**
     * Update this room instance
     *
     * @returns {Promise<boolean>}
     */
    async update(state) {
        try {
            return await putHue('rooms', this.id, state).then(() => {
                if (state.on !== null) {
                    this.state.all_on = state.on;
                    this.state.any_on = state.on;
                }

                this.action = {...this.action, ...state}
            });
        } catch (e) {
            throw e;
        }
    }

    /**
     * Set the Icon for the resource
     *
     * @param {String} type
     * @returns {Room}
     */
    async setIcon(type) {
        this.lastTransition = (type === '+' ? 'slide-left' : 'slide-right');

        let i = this.findIndex();
        let newIndex = (type === '+' ? i + 1 : i - 1);

        if (newIndex === groupsMap.length)
            newIndex = 0;

        else if (newIndex === 0)
            newIndex = (groupsMap.length - 1);

        const upper = groupsMap[newIndex];

        return this.class = upper[0].toUpperCase() + upper.slice(1);
    }

    /**
     * Set an random icon
     *
     * @returns {Room}
     */
    setRandomIcon() {
        const randomNumber = Math.random() * groupsMap.length;
        const upper = groupsMap[Math.round(randomNumber)];

        return this.class = upper[0].toUpperCase() + upper.slice(1);
    }
}
