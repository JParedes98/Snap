import Vue from 'vue';
import Vuex from 'vuex';

import state from './state';
import mutations from './mutations';
import actions from './actions';
import getters from './Getters';

Vue.use(Vuex)

export default {
    state,
    mutations,
    actions,
    getters
}
