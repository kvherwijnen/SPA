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

import globalRoutes from "./global";
import errorRoutes from "./error";
import adminRoutes from "./admin";
import settingsRoutes from './settings';
import { hueRoutes } from "./hue";

const allRoutes = [                                // This array has all routes, even the error routes
    globalRoutes,
    hueRoutes,
    errorRoutes,
    settingsRoutes,
];

// if(Vue.user)
allRoutes.push(adminRoutes);

const routes = [];                                                  // We need this, because we now have 2 separate arrays

allRoutes.forEach((array, index) => {         // So we loop in that array, all the arrays, still get me?
    array.forEach(route => {
        if (index === 5)
            route.meta.admin = index === 5;                         // And ofcourse for each array we push each route to the router array

        routes.push(route);
    });
});

export default routes;
