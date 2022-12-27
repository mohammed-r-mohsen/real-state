export default {
    mode: "history",

    scrollBehavior() {
        return { x: 0, y: 0, behavior: "smooth" };
    },
    routes: [
        {
            path: "/",
            component: require("./components/Home/Welcome.vue").default,
        },
        {
            path: "/about",
            component: require("./components/Home/About.vue").default,
            name: "about",
        },
        {
            path: "/services",
            component: require("./components/Home/Services.vue").default,
            name: "services",
        },
        {
            path: "/contact",
            component: require("./components/Home/Contact.vue").default,
            name: "contact",
        },
        {
            path: "/faqs",
            component: require("./components/Home/Faqs.vue").default,
            name: "faqs",
        },
        {
            path: "/terms",
            component: require("./components/Home/Terms.vue").default,
            name: "terms",
        },
        {
            path: "/privacy",
            component: require("./components/Home/privacy.vue").default,
            name: "privacy",
        },
        {
            path: "/login",
            component: require("./components/Home/Auth/Login.vue").default,
            meta: { IsAuth: true },
        },
        {
            path: "/register",
            component: require("./components/Home/Auth/Register.vue").default,
            meta: { IsAuth: true },
        },
        {
            path: "/google_callback",
            component: require("./components/Home/Auth/GoogleLogin.vue")
                .default,
            meta: { IsAuth: true },
        },
        {
            path: "/facebook_callback",
            component: require("./components/Home/Auth/FacebookLogin.vue")
                .default,
            meta: { IsAuth: true },
        },
        {
            path: "/forget_password",
            name: "forget_password",
            component: require("./components/Home/Auth/Forget.vue").default,
            meta: { IsAuth: true },
        },
        {
            path: "/reset_password",
            name: "reset_password",
            component: require("./components/Home/Auth/Reset.vue").default,
            meta: { IsAuth: true },
        },
        {
            path: "/change_password",
            name: "change_password",
            component: require("./components/Home/Auth/ChangePassword.vue")
                .default,
            meta: { requiresAuth: true },
        },
        {
            path: "/home",
            component: require("./components/Home/Home.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/edit_profile",
            component: require("./components/Home/EditProfile.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/my_packages",
            component: require("./components/Home/MyPackages.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/add_package",
            component: require("./components/Home/AddPackage.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/add_advertisement/:step",
            component: require("./components/Home/AddAd.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/my_advertisements",
            component: require("./components/Home/MyAds.vue").default,
            meta: { requiresAuth: true },
        },
        {
            path: "/view_advertisement/:slug",
            component: require("./components/Home/AdDetails.vue").default,
            props: true,
            name: "view_advertisement",
        },
        {
            path: "/edit_advertisement/:slug",
            component: require("./components/Home/EditAd.vue").default,
            props: true,
            name: "view_advertisement",
            meta: { requiresAuth: true },
        },
        {
            path: "/filter_advertisements",
            component: require("./components/Home/AdsFilter.vue").default,
            props: true,
            name: "filter_ads",
        },
        {
            path: "/providers",
            component: require("./components/Home/Providers.vue").default,
            name: "providers",
        },
        {
            path: "/provider/:name/:id",
            component: require("./components/Home/ProviderProfile.vue").default,
            name: "provider",
        },
        {
            path: "/favorites",
            component: require("./components/Home/Favorites.vue").default,
            name: "favorites",
            meta: { requiresAuth: true },
        },
        {
            path: "/clients_review",
            component: require("./components/Home/ClientsReview.vue").default,
            name: "clients_review",
            meta: { requiresAuth: true },
        },
        {
            path: "/reports",
            component: require("./components/Home/Reports.vue").default,
            name: "reports",
            meta: { requiresAuth: true },
        },
        {
            path: "/messages",
            component: require("./components/Home/Messages.vue").default,
            name: "messages",
            meta: { requiresAuth: true },
        },
        {
            path: "/notifications",
            component: require("./components/Home/Notifications.vue").default,
            name: "notifications",
            meta: { requiresAuth: true },
        },
        {
            path: "/verify_email",
            component: require("./components/Home/Auth/EmailVerification.vue").default,
            name: "verify_email",
            meta: { isVerified: false },
        },

        {
            path: "/:catchAll(.*)",
            component:
                require("./components/Home/Elements/NotFoundComponent.vue")
                    .default,
            name: "NotFound",
        },
    ],
};