const routes = [
    // AUTHENTICATION ROUTES
    {
        path: "/login",
        name: 'login',
        meta: { module: 'auth' },
        component: require("../pages/auth/Login").default,
    },
    {
        path: "/signup",
        name: 'signup',
        meta: { module: 'auth' },
        component: require("../pages/auth/SignUp").default,
    },
];

export default routes;
