import types from './types';

const success = (state, obj) => {
    state.items = obj.items;
    state.type = obj.type;
    state.loading = false;
}

const loading = (state, obj) => {
    state.type = obj.type;
    state.loading = true;
}

export default {
    [types.SUCCESS]: success,
    [types.LOADING]: loading
}

