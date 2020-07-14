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

import HueItem from "./HueItem";

export class Bridge extends HueItem {
    constructor(data = {}) {
        super(data);
        this.name = data.name;
        this.zigbeechannel = data.zigbeechannel || 0;
        this._bridgeid = data._bridgeid || '';
        this.bridge = data.bridge || Object;
        this.internetservices = data.internetservices;
    }
}
export default Bridge;
