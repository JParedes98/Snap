const routes = [
    {
        path: "/app",
        meta: { module: 'app' },
        component: require("../pages/AppRoutes.vue").default,
        children: [
            // WELCOME ROUTE
            { path: "", name: 'app', component: require("../pages/Dashboard.vue").default, },

            // FILES ROUTES
            { path: "files", name: 'files', component: require("../pages/resources/files/Index").default, },

            // SNIPPETS ROUTES
            { path: "snippets", name: 'snippets', component: require("../pages/resources/snippets/Index").default, },

            // LINKS ROUTES
            { path: "links", name: 'links', component: require("../pages/resources/links/Index").default, },
        ]
    },
];

export default routes;
