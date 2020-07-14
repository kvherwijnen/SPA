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

class GetAPI {
    constructor(data) {
        this._data = {
            headers: {}
        }
    }

    get() {
        return this.method('GET');
    }

    post() {
        return this.method('POST');
    }

    put() {
        return this.method('PUT');
    }

    delete() {
        return this.method('DELETE');
    }

    method(method) {
        this._getData().method = method;
        return this;
    }

    acceptJson() {
        return this.setHeader('Accept', 'application/json');
    }

    acceptXml() {
        return this.setHeader('Accept', 'application/xml');
    }

    pureJson() {
        this._getData().json = true;
        return this;
    }

    _getData() {
        return this._data;
    }
}

export default GetAPI;
