export default {
    getLinksList({ commit }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.get('/api/admin/links')
                .then( res => {
                    commit('setLinksList', res.data);
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },
    createUpdateLink({ state, commit, dispatch }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');

            let reqUrl           = state.link.id ? '/api/admin/links/' + state.link.id : '/api/admin/links';
            let reqType          = state.link.id ? 'PUT' : 'POST';

            axios({
                method: reqType,
                url: reqUrl,
                data: state.link
            })
                .then( res => {
                    dispatch('getLinksList');
                    commit('resetLink');
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('resetLink');
                    commit('show_hide_loader');
                    reject(error)
                })
        })
    },
    deleteLink({ commit, dispatch }, link) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.delete(`/api/admin/links/${link.id}`)
                .then( res => {
                    dispatch('getLinksList');
                    commit('resetLink');
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('resetLink');
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },

}
