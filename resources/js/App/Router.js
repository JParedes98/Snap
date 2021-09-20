import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './Store';

Vue.use(VueRouter);

import Redirects from './routes/Redirects';
import Auth from './routes/Auth';
import VisitorRoutes from './routes/VisitorRoutes';
import AdminRoutes from './routes/AdminRoutes';

const empty_routes = [];
const routes = empty_routes.concat(Redirects, Auth, VisitorRoutes, AdminRoutes);
const router = new VueRouter({
    routes
});


router.beforeEach((to, from, next) => {
    let auth_user = store.getters['users/user_is_authenticated'];
    let token_expiration = store.getters['users/token_expiration'];

    let session_time = Math.abs(new Date() - new Date(token_expiration)) / 36e5;
    if (session_time > 1) {
        store.dispatch('users/logout')
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
