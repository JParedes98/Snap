const routes = [
    // PORTAL ROUTES
    {
        path: "/app",
        meta: { module: 'app' },
        component: require("../pages/Visitors.vue").default,
        children: [
            // WELCOME ROUTE
            { path: "", name: 'app', component: require("../pages/visitors/Welcome.vue").default, },
        ]
    },
];

export default routes;
