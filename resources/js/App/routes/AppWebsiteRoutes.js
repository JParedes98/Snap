const routes = [
    {
        path: "/",
        meta: { module: 'website' },
        component: require("../AppWebsite.vue").default,
        children: [
            // FILES ROUTES
            { path: "", name: 'website_files', component: require("../pages/website/Files").default, },

            // SNIPPETS ROUTES
            { path: "snippets", name: 'website_snippets', component: require("../pages/website/Snippets").default, },

            // LINKS ROUTES
            { path: "links", name: 'website_links', component: require("../pages/website/Links").default, },
        ]
    },
];

export default routes;
