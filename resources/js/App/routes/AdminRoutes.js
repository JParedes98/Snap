const routes = [{
    path: "/admin",
    meta: { module: 'app' },
    component: require("../pages/Admin").default,
    children: [
        // WELCOME ROUTE
        { path: "", name: 'admin', component: require("../pages/admin/Welcome").default, },
    ]
}];

export default routes;
