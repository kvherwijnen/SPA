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

export const globalRoutes = [
    {
        path: '/login',
        component: getComponent('Authentication'),
        name: 'Authenticatie',
        hidden: true,
        meta: {
            transitionName: 'zoom',
        }
    },
    {
        path: '/logout',
        component: getComponent('Authentication', 'Logout'),
        hidden: true,
        meta: {
            transitionName: 'zoom'
        }
    },
    {
        path: '/',
        component: getComponent('Dashboard'),
        name: "Dashboard",
        meta: {
            transitionName: 'slide',
            numberInLine: 1,
            auth: true,
            icon: 'home',
        }
    },
    {
        path: "/store",
        component: getComponent('Store'),
        name: "store",
        hidden: true,
        meta: {
            transitionName: 'slide',
            numberInLine: 2,
            auth: true
        }
    },
    {
        path: "/hue/lights",
        component: getComponent('Hue', 'Lights'),
        name: "Lights",
        hidden: true,
        meta: {
            transitionName: 'slide',
            auth: true
        }
    },
    {
        path: "/hue/rooms",
        name: "Rooms",
        component: getComponent('Hue', 'Rooms'),
        meta: {
            transitionName: 'slide',
            numberInLine: 3,
            icon: 'groupbulb',
            iconType: 'lights'
        }
    },
    {
        path: "/hue/rooms/:id",
        component: getComponent('Hue/Room', 'Detail'),
        name: "Kamer details",
        hidden: true,
        meta: {
            transitionName: 'zoom',
            auth: true
        }
    },
    {
        path: "/hue/rooms/create",
        component: getComponent('Hue/Room', 'Create'),
        name: "Create Room",
        hidden: true,
        meta: {
            transitionName: 'zoom',
            auth: true
        }
    },
    {
        path: "/hue/bridge",
        component: getComponent('Hue', 'Bridge'),
        name: "Update Bridge",
        hidden: true,
        meta: {
            transitionName: 'slide',
            numberInLine: 4,
            auth: true
        }
    },
    {
        path: "/hue/scenes/create",
        component: getComponent('Hue/Scenes', 'Create'),
        name: "Scenes",
        meta: {
            transitionName: 'slide',
            numberInLine: 5,
            auth: true,
            icon: 'digg'
        }
    },

    {
        path: "/camera",
        component: getComponent('Native'),
        name: "Native",
        meta: {
            transitionName: 'zoom',
            auth: true,
            icon: 'camera'
        }
    },
    {
        path: "/gallery",
        component: getComponent('Native', 'Gallerij'),
        name: "Gallerij",
        hidden: true,
        meta: {
            transitionName: 'slide',
            numberInLine: 4,
            auth: true,
            icon: 'images'
        }
    },
    {
        path: "/settings",
        component: getComponent('Settings'),
        name: "You",
        meta: {
            transitionName: 'slide',
            numberInLine: 8,
            auth: true,
            icon: 'settings'
        }
    }
];

export default globalRoutes;
