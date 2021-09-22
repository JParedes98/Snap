export default {
    async GetList({ commit }, resource) {
        commit('show_hide_loader');
        await axios.get(`/api/${resource}`)
            .then( res => {
                switch (resource) {
                    case 'files':
                        commit('setWebsiteFilesList', res.data);
                        break;

                    case 'snippets':
                        commit('setWebsiteSnippetsList', res.data);
                        break;

                    case 'links':
                        commit('setWebsiteLinksList', res.data);
                        break;
                }
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },
}
