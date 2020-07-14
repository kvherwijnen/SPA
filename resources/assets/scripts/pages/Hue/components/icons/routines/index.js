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
// TODO: Fill all these
export default {
    Cominghome: () => import('./Cominghome'),
    Daytime: () => import('./Daytime'),
    GoToSleep: () => import('./GoToSleep'),
    HomeAway: () => import('./HomeAway'),
};

export const routinesMap = [
    'cominghome',
    'daytime',
    'go-to-sleep',
    'home-away'
];
