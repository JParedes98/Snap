export default {
    getSnippetsList({ commit }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.get('/api/admin/snippets')
                .then( res => {
                    commit('setSnippetsList', res.data);
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },
    createUpdateSnippet({ state, commit, dispatch }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');

            let reqUrl           = state.snippet.id ? '/api/admin/snippets/' + state.snippet.id : '/api/admin/snippets';
            let reqType          = state.snippet.id ? 'PUT' : 'POST';

            axios({
                method: reqType,
                url: reqUrl,
                data: state.snippet
            })
                .then( res => {
                    dispatch('getSnippetsList');
                    dispatch('resetSnippet');
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    dispatch('resetSnippet');
                    commit('show_hide_loader');
                    reject(error)
                })
        })
    },
    deleteSnippet({ commit, dispatch }, snippet) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.delete(`/api/admin/snippets/${snippet.id}`)
                .then( res => {
                    dispatch('getSnippetsList');
                    dispatch('resetSnippet');
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    dispatch('resetSnippet');
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },

}
