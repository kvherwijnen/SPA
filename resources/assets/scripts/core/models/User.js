import Preferences from './Preferences';

export default class User {
    constructor(data = {}) {
        this.id = data.id;
        this.name = data.name;
        this.email = data.email;
        this.firstName = data.first_name || data.firstName;
        this.prefix = data.prefix || '';
        this.lastName = data.last_name || data.lastName;
        this.preferences = new Preferences(data.preferences);
    }

    /**
     * Get the users full name
     *
     * @returns {String}
     */
    getFullName() {
        return this.firstName + ' ' + this.prefix + ' ' + this.lastName;
    }
}
