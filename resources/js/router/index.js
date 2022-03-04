import { createRouter, createWebHistory } from "vue-router";
import store from "../store";

const routes = [
    {
        path: '/signin',
        name: 'Signin',
        component: () => import('../views/auth/Signin.vue'),
        meta: {
            title: 'Sign in'
        },
        beforeEnter:(to, from, next) => {
            if (store.getters['auth/authenticated']) {
                return next({ name: 'Dashboard' })
            }
            next();
        }

    },
    {
        path: '/',
        name: 'Dashboard',
        component: () => import('../views/Dashboard.vue'),
        meta: {
            title: 'Dashboard'
        },
    },
    {
        path: '/profile',
        name: 'Profile',
        component: () => import('../views/profile/Profile.vue'),
        meta: {
            title: 'Profile'
        }
    },
    {
        path: '/villages',
        name: 'Village',
        component: () => import('../views/village/Index.vue'),
        meta: {
            title: 'Village'
        }
    },
    {
        path: '/postoffice',
        name: 'Postoffice',
        component: () => import('../views/postoffice/Index.vue'),
        meta: {
            title: 'Post office'
        }
    },
    {
        path: '/admins',
        name: 'Admin',
        component: () => import('../views/admin/Index.vue'),
        meta: {
            title: 'Admin list'
        }
    },
    {
        path: '/admins/:admin_id',
        name: 'ShowAdmin',
        component: () => import('../views/admin/Profile.vue'),
        meta: {
            title: 'Admin show'
        }
    },
    {
        path: '/members/group',
        name: 'MemberGroup',
        component: () => import('../views/member-group/Index.vue'),
        meta: {
            title: 'Members groups'
        }
    },
    {
        path: '/members',
        name: 'Members',
        component: () => import('../views/member/Index.vue'),
        meta: {
            title: 'Members list'
        },
    },
    {
        path: '/members/show/:member_id',
        name: 'MemberShow',
        component: () => import('../views/member/Show.vue'),
        meta: {
            title: 'Member Details'
        },
    },
    {
        path: '/members/create',
        name: 'CreateMember',
        component: () => import('../views/member/Create.vue'),
        meta: {
            title: 'Add new member'
        }
    },
    {
        path: '/members/edit/:member_id',
        name: 'EditMember',
        component: () => import('../views/member/Edit.vue'),
        meta: {
            title: 'Update member'
        }
    },
    {
        path: '/application/dps',
        name: 'ApplicationDPS',
        component: () => import('../views/application/dps/Index.vue'),
        meta: {
            title: 'DPS application list'
        },
    },
    {
        path: '/application/dps/create',
        name: 'CreateDPS',
        component: () => import('../views/application/dps/Create.vue'),
        meta: {
            title: 'DPS Application Create'
        },
    },
    {
        path: '/application/loans',
        name: 'ApplicationLoan',
        component: () => import('../views/application/loan/Index.vue'),
        meta: {
            title: 'Loan application list'
        },
    },
    {
        path: '/application/loans/create',
        name: 'CreateLoan',
        component: () => import('../views/application/loan/Create.vue'),
        meta: {
            title: 'Loan application Create'
        },
    },
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: () => import('../views/404.vue'),
        meta: {
            title: '404 | Page not found'
        }
    }
]

const BASE_URL = '/';
const router = createRouter({
    history: createWebHistory(BASE_URL),
    routes
})

router.beforeEach((to, from, next) => {
    window.document.title = to.meta && to.meta.title ? to.meta.title : 'PDSCDCSL';
    let exceptRoutes = ['Signin', 'NotFound'];
    if (!exceptRoutes.find((route) => {
        return route === to.name
    })) {
        if (!store.getters['auth/authenticated']) {
            return next({
                name: 'Signin'
            })
        }
    }
    next();
})

export default router;

