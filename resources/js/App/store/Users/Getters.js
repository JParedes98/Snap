export  default {
    user_is_authenticated: state => {
        return Boolean(state.token);
    },

    user: state => {
        return state.user;
    },

    token: state => {
        return state.token;
    },

    token_expiration: state => {
        return state.token_expiration;
    },
}
