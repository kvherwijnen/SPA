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

import types from './types';
import Bridge from "Core/models/Bridge";
import Room from "Core/models/Room";
import Scene from 'Core/models/Scene';
import Light from "Core/models/Light";
import ResourceLink from "Core/models/ResourceLink";
import Sensor from "Core/models/Sensor";

function generateObject(type, item) {
    switch (type) {
        case 'bridge':
            return new Bridge(item);
        case 'rooms':
            return new Room(item);
        case 'lights':
            return new Light(item);
        case 'scenes':
            return new Scene(item);
        case 'resourcelinks':
            return new ResourceLink(item);
        case 'sensors':
            return new Sensor(item);
    }
}

const initialize = async ({commit, state}, type) => {
    if (state.items.length === 0 && !state.loading) {
        commit(types.LOADING, {type: type});

        await fetch({commit, state}, type, true);
    }
}

const fetch = async ({commit, state}, type, init = false) => {
    if (init || (state.items.length > 0 && !state.loading)) {
        try {
            return await axios.get(type).then(response => {
                const items = response.data;
                let itemModels = [];

                if (Array.isArray(items))
                    items.forEach(item => itemModels.push(generateObject(type, item)));

                else
                    itemModels.push(generateObject(type, items));

                commit(types.SUCCESS, {items: itemModels, type: type});
            });
        } catch (e) {
            throw e;
        }
    }
}

const store = async ({commit, state}, value) => {
    commit(types.LOADING);

    const items = state.items.unshift(generateObject(type, value));
    commit(types.SUCCESS, {items: items, type: state.type});
}

const update = async ({commit, state}, value) => {
    commit(types.LOADING);

    const items = [...state.items.map(item => item.id !== item.id ? item : {...item, ...value})];
    commit(types.SUCCESS, {items: items, type: state.type});
}

const remove = async ({commit, state}, value) => {
    commit(types.LOADING);

    const items = state.items.splice(state.items.indexOf(value), 1);
    commit(types.SUCCESS, {items: items, type: state.type});
}

export default {
    initialize,
    fetch,
    store,
    update,
    remove
}
