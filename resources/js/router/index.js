import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/Home.vue'),        
        meta: {
            title: 'Dashboard'
        }
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
    window.document.title = to.meta && to.meta.title ? to.meta.title : 'Home';
    next();
})

export default router;