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

// TODO: fill all these
const e = {
    Colorscenes: () => import('./Colorscenes'),
    Photoscene: () => import('./Photoscene'),
};

export const UIControlsMap = [
    'bridge',
    'error',
    'colorloop',
    'colorscenes',
    'photoscene',
    'plus',
    'scenes',
    'switchoff',
    'switchon'
];

export default UIControlsMap;
