export default {
    async getSnippetsList({ commit }) {
        commit('show_hide_loader');
        await axios.get('/api/admin/snippets')
            .then( res => {
                commit('setSnippetsList', res.data);
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },
    async createUpdateSnippet({ state, commit, dispatch }) {
        commit('show_hide_loader');

        let reqUrl           = state.snippet.id ? '/api/admin/snippets/' + state.snippet.id : '/api/admin/snippets';
        let reqType          = state.snippet.id ? 'PUT' : 'POST';
        let successMessage   = state.snippet.id ? 'Snippet created successfully.' : 'Snippet updated successfully';

        await axios({
                method: reqType,
                url: reqUrl,
                data: state.snippet
            })
            .then( res => {
                dispatch('getSnippetsList');
                this.ShowMessagePopUp({
                    icon: 'success',
                    title: 'Awesome!',
                    text: successMessage,
                });
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },
    async deleteSnippet({ commit, dispatch }, snippet) {
        commit('show_hide_loader');
        await axios.delete(`/api/admin/snippets/${snippet.id}`)
            .then( res => {
                dispatch('getSnippetsList');
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },

}
