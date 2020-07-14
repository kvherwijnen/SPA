const authorize = {
    tokenDefaultName: 'Sheep_AI',
    tokenStore: ['localStorage', 'cookie'],
    registerData: {url: 'auth/register', method: 'POST', redirect: '/register'},
    loginData: {url: 'auth/login', method: 'POST', redirect: '/'},
    logoutData: {url: 'auth/logout', method: 'POST', makeRequest: true},
    fetchData: {url: 'auth/user', method: 'GET', enabled: true},
    refreshData: {url: 'auth/refresh', method: 'GET', enabled: true, interval: 30},
};

export default authorize;
