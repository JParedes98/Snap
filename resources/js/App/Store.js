import Vue from 'vue';
import Vuex from 'vuex';

// STORE IMPORTS
import UsersStore from "./store/Users";
import WebsiteStore from "./store/Website";
import FilesStore from "./store/Files";
import SnippetsStore from "./store/Snippets";
import LinksStore from "./store/Links";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        'users': UsersStore,
        'website': WebsiteStore,
        'files': FilesStore,
        'snippets': SnippetsStore,
        'links': LinksStore,
    },

    state: {
        loader_is_active: false,
    },

    mutations: {
        show_hide_loader(state) {
            state.loader_is_active = !state.loader_is_active;
        }
    },

    actions: {
        show_hide_loader({ commit }) {
            return new Promise((resolve, reject) => {
                commit('show_hide_loader');
                resolve();
            });
        }
    },

    getters: {
        loader_is_active: state => {
            return state.loader_is_active;
        },
    }
});


export default store;
