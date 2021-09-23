export default {
    setSnippetsList(state, list) {
        state.list = list;
    },

    setSnippetObject(state, snippet) {
        state.snippet.id            = snippet.id;
        state.snippet.title         = snippet.title;
        state.snippet.description   = snippet.description;
        state.snippet.isPrivate     = snippet.is_private;
        state.snippet.html          = snippet.html;
    },

    resetSnippet(state) {
        state.snippet.id            = '';
        state.snippet.title         = '';
        state.snippet.description   = '';
        state.snippet.isPrivate     = false;
        state.snippet.html          = '';
    }
}
