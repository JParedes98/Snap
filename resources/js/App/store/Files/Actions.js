export default {
    async getFilesList({ commit }) {
        commit('show_hide_loader');
        await axios.get('/api/admin/files')
            .then( res => {
                commit('setFilesList', res.data);
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },
    async createUpdateFile({ state, commit, dispatch }) {
        commit('show_hide_loader');

        let reqUrl           = state.file.id ? '/api/admin/files/' + state.file.id : '/api/admin/files';
        let successMessage   = state.file.id ? 'File created successfully.' : 'File updated successfully';

        let formData = new FormData();
        formData.append('title', state.file.title);
        formData.append('pdf', state.file.pdf);
        formData.append('isPrivate', state.file.isPrivate === true ? 1 : 0 );
        formData.append('_method', state.file.id ? 'PUT' : 'POST');

        await axios({
                method: 'POST',
                url: reqUrl,
                data: formData
            })
            .then( res => {
                dispatch('getFilesList');
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
    async deleteFile({ commit, dispatch }, file) {
        commit('show_hide_loader');
        await axios.delete(`/api/admin/files/${file.id}`)
            .then( res => {
                dispatch('getFilesList');
                commit('show_hide_loader');
            })
            .catch(error => {
                console.log(error);
                commit('show_hide_loader');
            })
    },

}
