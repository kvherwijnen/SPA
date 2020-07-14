const LoaderComponent = null;           // Zou leuk zijn, ooit, met P ofzo
const ErrorComponent = null;            // Zou leuk zijn, ooit, met P ofzo

export let getComponent = (dir = '', page = '') => {
    return () => ({
        component: import( /* webpackChunkName: "page-[request]" */ '../../pages/' + dir + '/' + page),
        loading: LoaderComponent,
        error: ErrorComponent,
        delay: 0, // default 200ms;
        timeout: 3000 // default infinity
    })
};

export let checkEmail = (email) => {
    const pattern = /\S+@\S+\.\S+/;
    return pattern.test(email);
}

export let validateUsername = (rule, value, callback) => {
    if (value === '')
        return callback(new Error('Vul alsjeblieft een gebruikersnaam in'));

    else if (checkEmail(value))
        return callback(new Error('Gebruik een gebruikersnaam i.p.v. email'));

    else return callback();
}

export let validatePassword = (rule, value, callback) => {
    if (value === '')
        return callback(new Error('Vul alsjeblieft een wachtwoord in'));

    else return callback();
}
