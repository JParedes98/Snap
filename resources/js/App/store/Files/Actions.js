export default {
    getFilesList({ commit }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.get('/api/admin/files')
                .then( res => {
                    commit('setFilesList', res.data);
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },
    createUpdateFile({ state, commit, dispatch }) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');

            let reqUrl           = state.file.id ? '/api/admin/files/' + state.file.id : '/api/admin/files';
            let successMessage   = state.file.id ? 'File created successfully.' : 'File updated successfully';

            let formData = new FormData();
            formData.append('title', state.file.title);
            formData.append('pdf', state.file.pdf);
            formData.append('isPrivate', state.file.isPrivate === true ? 1 : 0 );
            formData.append('_method', state.file.id ? 'PUT' : 'POST');

            axios({
                method: 'POST',
                url: reqUrl,
                data: formData
            })
                .then( res => {
                    dispatch('getFilesList');
                    dispatch('resetFile');
                    commit('show_hide_loader');
                    resolve(res)
                })
                .catch(error => {
                    dispatch('resetFile');
                    commit('show_hide_loader');
                    reject(error);
                })
        })
    },
    deleteFile({ commit, dispatch }, file) {
        return new Promise((resolve, reject) => {
            commit('show_hide_loader');
            axios.delete(`/api/admin/files/${file.id}`)
                .then( res => {
                    dispatch('getFilesList');
                    dispatch('resetFile');
                    commit('show_hide_loader');
                    resolve(res);
                })
                .catch(error => {
                    commit('show_hide_loader');
                    dispatch('resetFile');
                    reject(error);
                })
        })
    },

}
