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

export async function getHue(type, id = null) {
    try {
        if (id)
            return await axios.get('/' + type + '/' + id);

        else
            return await axios.get('/' + type);
    } catch (e) {
        return e;
    }
}

export async function removeHue(type, id) {
    try {
        return await axios.delete('/' + type + '/' + id);
    } catch (e) {
        return e;
    }
}

export async function postHue(type, request) {
    try {
        return await axios.post('/' + type + '/', request);
    } catch (e) {
        return e;
    }
}

export async function putHue(type, id, request, state = true) {
    try {
        return await axios.put('/' + type + '/' + id + (state ? '/state' : ''), request);
    } catch (e) {
        return e;
    }
}
