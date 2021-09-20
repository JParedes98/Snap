import Vue from 'vue';
import VueRouter from 'vue-router';

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

export default router;
