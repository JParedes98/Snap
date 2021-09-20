export default {
    auth_success(state, res) {
        const token = res.data.access_token;
        const user = res.data.user;
        const token_expiration = Date();

        localStorage.setItem('jwt_token', token);
        localStorage.setItem('token_expiration', token_expiration);
        localStorage.setItem('user', JSON.stringify(user));

        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        state.token = localStorage.getItem('jwt_token');
        state.token_expiration = localStorage.getItem('token_expiration');
        state.user = JSON.parse(localStorage.getItem('user'));
    },

    logout(state) {
        state.token = '';
        state.token_expiration = '';
        state.user = null;
    },

    set_user_data(state, user) {
        state.user = user;
    },
}
