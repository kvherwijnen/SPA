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

export const errorRoutes = [
    {path: '*', redirect: '/404'},
    {
        path: '/404',
        name: 'Pagina niet gevonden',
        component: getComponent('Errors', 'NotFound'),
    },
    {
        path: '/403',
        name: 'Forbidden',
        component: getComponent('Errors', 'Forbidden'),
    },
    {
        path: '/401',
        name: 'Unauthorized',
        component: getComponent('Errors', 'Unauthorized'),
    }
];

export default errorRoutes;
