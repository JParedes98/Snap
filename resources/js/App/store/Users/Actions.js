export default {
    login({
              commit
          }, user) {
        return new Promise((resolve, reject) => {
            var formData = new FormData();
            formData.append('email', user.email);
            formData.append('password', user.password);

            axios.post('/api/auth/login', formData)
                .then(res => {
                    commit('auth_success', res);
                    resolve(res);
                })
                .catch(err => {
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('token_expiration');
                    localStorage.removeItem('user');
                    reject(err);
                })
        })
    },

    logout({commit}){
        return new Promise((resolve, reject) => {
            axios.post('/api/auth/logout');

            localStorage.removeItem('jwt_token');
            localStorage.removeItem('token_expiration');
            localStorage.removeItem('user');

            delete axios.defaults.headers.common['Authorization'];
            commit('logout');

            resolve()
        });
    },

    set_user_data({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/profile/GetMyProfile')
                .then(res => {
                    localStorage.setItem('user', JSON.stringify(res.data));
                    commit('set_user_data', res.data);
                    resolve(res);
                })
                .catch(err => {
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('token_expiration');
                    localStorage.removeItem('user');
                    reject(err);
                })
        });
    },
}
