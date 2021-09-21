export default {
    async getLinksList({ commit }) {
        commit('show_hide_loader');
        await axios.get('/api/admin/links')
            .then( res => {

                commit('setLinksList', res.data);
                commit('show_hide_loader');
            })
            .catch(error => {
                this.ShowMessagePopUp({
                    icon: 'error',
                    title: 'Ups, something went wrong.',
                    text: error.response.data.message,
                });
                commit('show_hide_loader');
            })
    },
    async createUpdateLink({ state, commit, dispatch }) {
        commit('show_hide_loader');

        let reqUrl           = state.link.id ? '/api/admin/links/' + state.link.id : '/api/admin/links';
        let reqType          = state.link.id ? 'PUT' : 'POST';
        let successMessage   = state.link.id ? 'Link created successfully.' : 'Link updated successfully';

        await axios({
                method: reqType,
                url: reqUrl,
                data: state.link
            })
            .then( res => {
                dispatch('getLinksList');
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
    async deleteLink({ commit, dispatch }, link) {
        commit('show_hide_loader');
        await axios.delete(`/api/admin/links/${link.id}`)
            .then( res => {
                dispatch('getLinksList');
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },

}
