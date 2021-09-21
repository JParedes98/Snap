import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './Store';

Vue.use(VueRouter);

import Redirects from './routes/Redirects';
import AuthRoutes from './routes/AuthRoutes';
import AppRoutes from './routes/AppRoutes';

const empty_routes = [];
const routes = empty_routes.concat(Redirects, AuthRoutes, AppRoutes);
const router = new VueRouter({
    // mode: 'history',
    routes: routes,
});


router.beforeEach((to, from, next) => {
    let auth_user = store.getters['user_is_authenticated'];
    let token_expiration = store.getters['token_expiration'];

    let session_time = Math.abs(new Date() - new Date(token_expiration)) / 36e5;
    if (session_time > 1) {
        store.dispatch('logout')
            .then(() => {
                next({ name: 'login' })
            });
    }

    if (to.matched.some(record => record.meta.module == 'auth')) {
        if (auth_user) {
            next({ name: 'app' });
        }

        next();
    }

    if (to.matched.some(record => record.meta.module == 'app')) {
        if (!auth_user) {
            next({ name: 'login' });
        }

        next();
    }

    next();
});


export default router;
