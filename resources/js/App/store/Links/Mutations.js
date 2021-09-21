export default {
    setLinksList(state, list) {
        state.list = list;
    },

    setLinkObject(state, link) {
        state.link.id            = link.id;
        state.link.title         = link.title;
        state.link.url           = link.url;
        state.link.openNewTab    = link.open_in_new_tab;
        state.link.isPrivate     = link.is_private;
    }
}
