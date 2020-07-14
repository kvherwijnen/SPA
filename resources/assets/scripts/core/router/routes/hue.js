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

export const hueRoutes = [
    {
        path: '/hue',
        name: 'Hue',
        component: getComponent('Hue'),
        meta: {
            auth: true,
            icon: 'groupbulb'
        },

        children: [
            {
                path: 'users',
                name: 'Hue Users',
                component: getComponent('Hue', 'Users')
            }
        ]
    }
];

export default hueRoutes;
