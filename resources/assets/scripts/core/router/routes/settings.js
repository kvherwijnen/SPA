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

import { getComponent } from "../../helpers";

export const settingsRoutes = [
    {
        path: "/about",
        component: getComponent('Settings/partials', 'About'),
        name: "About",
        meta: {
            transitionName: 'slide',
            numberInLine: 12,
            auth: true
        }
    },
    {
        path: '/help',
        component: getComponent('Settings/partials', 'Help'),
        name: "Help",
        meta: {
            transitionName: 'slide',
            numberInLine: 12,
            auth: true
        }
    },
    {
        path: '/security',
        component: getComponent('Settings/partials', 'Security'),
        name: "Security",
        meta: {
            transitionName: 'slide',
            numberInLine: 12,
            auth: true
        }
    },
    {
        path: '/privacy',
        component: getComponent('Settings/partials', 'Privacy'),
        name: "Privacy",
        meta: {
            transitionName: 'slide',
            numberInLine: 12,
            auth: true
        }
    },
    {
        path: '/appearance',
        component: getComponent('Settings/partials', 'Appearance'),
        name: "Appearance",
        meta: {
            transitionName: 'slide',
            numberInLine: 12,
            auth: true
        }
    }
];

export default settingsRoutes;
