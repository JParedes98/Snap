export default {
    setFilesList(state, list) {
        state.list = list;
    },

    setFileObject(state, file) {
        state.file.id            = file.id;
        state.file.title         = file.title;
        state.file.isPrivate     = file.is_private;
    }
}
