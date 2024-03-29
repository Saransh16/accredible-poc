import Vue from "vue";
import Router from "vue-router";

import LoginPage from '@/components/pages/LoginPage.vue';
import RegisterPage from '@/components/pages/RegisterPage.vue';
import Dashboard from '@/components/pages/Dashboard.vue';
import AdminContainer from '@/components/containers/AdminContainer.vue';
import Certificates from '@/components/pages/Certificates.vue';
import ViewCourse from '@/components/pages/ViewCourse.vue';
import Settings from '@/components/pages/Settings.vue';

Vue.use(Router);

function configRoutes() {
    return [
        {
            path: "/",
            name: "Login",
            component: LoginPage,
        },
        {
            path: "/register",
            name: "RegisterPage",
            component: RegisterPage
        },
        {
            path: "/",
            redirect: "/home",
            name: "admin",
            component: AdminContainer,
            children: [
              {
                path: "/dashboard",
                name: "dashboard",
                component: Dashboard
              },
              {
                path: "/certificates",
                name: "certificates",
                component: Certificates
              },
              {
                path: "/courses/:id",
                name: "view-course",
                component: ViewCourse
              },
              {
                path: "/settings",
                name: "settings",
                component: Settings
              }
            ]
        }
    ]
}

const router = new Router({
    mode: "history",
    linkExactActiveClass: "bg-gray-200",
    scrollBehavior: () => ({ y: 0 }),
    routes: configRoutes()
});

router.beforeEach((to, from, next) => {
    next();
});

export default router;
