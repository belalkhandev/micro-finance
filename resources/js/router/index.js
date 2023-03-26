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
            title: 'Village',
            permission: 'view_village'
        }
    },
    {
        path: '/postoffice',
        name: 'Postoffice',
        component: () => import('../views/postoffice/Index.vue'),
        meta: {
            title: 'Post office',
            permission: 'view_post_office'
        }
    },
    {
        path: '/admins',
        name: 'Admin',
        component: () => import('../views/admin/Index.vue'),
        meta: {
            title: 'Admin list',
            permission: 'view_admin'
        }
    },
    {
        path: '/admins/:admin_id',
        name: 'ShowAdmin',
        component: () => import('../views/admin/Profile.vue'),
        meta: {
            title: 'Admin show',
            permission: 'view_admin'
        }
    },
    {
        path: '/members/group',
        name: 'MemberGroup',
        component: () => import('../views/member-group/Index.vue'),
        meta: {
            title: 'Members groups',
            permission: 'view_group'
        }
    },
    {
        path: '/members',
        name: 'Members',
        component: () => import('../views/member/Index.vue'),
        meta: {
            title: 'Members list',
            permission: 'view_member'
        }
    },
    {
        path: '/members/group/:group_id',
        name: 'MemberGrouping',
        component: () => import('../views/member/MemberGroup.vue'),
        meta: {
            title: 'Members Group',
            permission: 'view_member'
        }
    },
    {
        path: '/members/:member_type',
        name: 'MemberType',
        component: () => import('../views/member/MemberType.vue'),
        meta: {
            title: 'Members Type',
            permission: 'view_member'
        }
    },
    {
        path: '/members/show/:member_id',
        name: 'MemberShow',
        component: () => import('../views/member/Show.vue'),
        meta: {
            title: 'Member Details',
            permission: 'view_member'
        }
    },
    {
        path: '/members/create',
        name: 'CreateMember',
        component: () => import('../views/member/Create.vue'),
        meta: {
            title: 'Add new member',
            permission: 'create_member'
        }
    },
    {
        path: '/members/edit/:member_id',
        name: 'EditMember',
        component: () => import('../views/member/Edit.vue'),
        meta: {
            title: 'Update member',
            permission: 'edit_member'
        }
    },
    {
        path: '/members/transactions/dps/:member_id',
        name: 'MemberDpsTransaction',
        component: () => import('../views/member/DpsTransaction.vue'),
        meta: {
            title: 'Member dps transaction history',
            permission: 'view_transaction'
        }
    },
    {
        path: '/members/transactions/loan/:member_id',
        name: 'MemberLoanTransaction',
        component: () => import('../views/member/LoanTransaction.vue'),
        meta: {
            title: 'Member loan transaction history',
            permission: 'view_transaction'
        }
    },
    {
        path: '/members/savings/account/:member_id',
        name: 'MemberSavingsProfile',
        component: () => import('../views/member/SavingsAccount.vue'),
        meta: {
            title: 'Member savings  history',
            permission: 'view_transaction'
        }
    },
    {
        path: '/members/applications/:member_id',
        name: 'MemberApplications',
        component: () => import('../views/member/Applications.vue'),
        meta: {
            title: 'Member transaction history',
            permission: 'view_application'
        }
    },
    {
        path: '/application/dps',
        name: 'ApplicationDPS',
        component: () => import('../views/application/dps/Index.vue'),
        meta: {
            title: 'DPS application list',
            permission: 'view_application'
        }
    },
    {
        path: '/application/dps/show/:application_id',
        name: 'showDPSApplication',
        component: () => import('../views/application/dps/Show.vue'),
        meta: {
            title: 'DPS Application details',
            permission: 'view_application'
        }
    },
    {
        path: '/application/dps/create',
        name: 'CreateDPS',
        component: () => import('../views/application/dps/Create.vue'),
        meta: {
            title: 'DPS Application Create',
            permission: 'create_application'
        }
    },
    {
        path: '/application/dps/edit/:application_id',
        name: 'EditDPSApplication',
        component: () => import('../views/application/dps/Edit.vue'),
        meta: {
            title: 'DPS Application Update',
            permission: 'edit_application'
        }
    },
    {
        path: '/application/loans',
        name: 'ApplicationLoan',
        component: () => import('../views/application/loan/Index.vue'),
        meta: {
            title: 'Loan application list',
            permission: 'view_application'
        }
    },
    {
        path: '/application/loans/create',
        name: 'CreateLoan',
        component: () => import('../views/application/loan/Create.vue'),
        meta: {
            title: 'Loan application Create',
            permission: 'create_application'
        }
    },
    {
        path: '/application/loans/edit/:application_id',
        name: 'EditLoanApplication',
        component: () => import('../views/application/loan/Edit.vue'),
        meta: {
            title: 'Loan application Update',
            permission: 'edit_application'
        }
    },
    {
        path: '/transaction',
        name: 'TransactionHome',
        component: () => import('../views/transaction/Index'),
        meta: {
            title: 'Transaction',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transaction/generate',
        name: 'GenerateTransaction',
        component: () => import('../views/transaction/GenerateTransaction'),
        meta: {
            title: 'Generate Transaction',
            permission: 'generate_transaction'
        },
    },
    {
        path: '/transactions/dps/list',
            name: 'DpsTransactionList',
            component: () => import('../views/transaction/DpsList'),
            meta: {
            title: 'All DPS transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transactions/dps/unpaid/list',
            name: 'DpsUnpaidTransactionList',
            component: () => import('../views/transaction/DpsUnpaidList'),
            meta: {
            title: 'Unpaid DPS transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transactions/dps/paid/list',
            name: 'DpsPaidTransactionList',
            component: () => import('../views/transaction/DpsPaidList'),
            meta: {
            title: 'Paid DPS transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transactions/loan/list',
        name: 'LoanTransactionList',
        component: () => import('../views/transaction/LoanList'),
        meta: {
            title: 'All loan transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transactions/loan/unpaid/list',
        name: 'LoanUnpaidTransactionList',
        component: () => import('../views/transaction/LoanUnpaidList'),
        meta: {
            title: 'Unpaid loan transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/transactions/loan/paid/list',
        name: 'LoanPaidTransactionList',
        component: () => import('../views/transaction/LoanPaidList'),
        meta: {
            title: 'Paid loan transaction list',
            permission: 'view_transaction'
        }
    },
    {
        path: '/expense/categories',
        name: 'ExpenseCategory',
        component: () => import('../views/expense-category/Index.vue'),
        meta: {
            title: 'Expense Categories',
            permission: 'view_expense'
        }
    },
    {
        path: '/expenses/list',
        name: 'ExpenseList',
        component: () => import('../views/expense/Index'),
        meta: {
            title: 'Expense list',
            permission: 'view_expense'
        }
    },
    {
        path: '/report/loan',
        name: 'LoanReport',
        component: () => import('../views/report/LoanReport'),
        meta: {
            title: 'Loan Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/dps',
        name: 'DpsReport',
        component: () => import('../views/report/DpsReport'),
        meta: {
            title: 'Dps Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/loan/today',
        name: 'TodayLoanReport',
        component: () => import('../views/report/TodayLoanReport'),
        meta: {
            title: 'Today Loan Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/loan/paid',
        name: 'PaidLoanReport',
        component: () => import('../views/report/PaidLoanReport'),
        meta: {
            title: 'Paid Loan Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/loan/due',
        name: 'DueLoanReport',
        component: () => import('../views/report/DueLoanReport'),
        meta: {
            title: 'Due Loan Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/dps/today',
        name: 'TodayDpsReport',
        component: () => import('../views/report/TodayDpsReport'),
        meta: {
            title: 'Today Dps Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/dps/paid',
        name: 'PaidDpsReport',
        component: () => import('../views/report/PaidDpsReport'),
        meta: {
            title: 'Paid Dps Report',
            permission: 'view_report'
        }
    },
    {
        path: '/report/dps/due',
        name: 'DueDpsReport',
        component: () => import('../views/report/DueDpsReport'),
        meta: {
            title: 'Due Dps Report',
            permission: 'view_report'
        }
    },
    {
        path: '/access-denied',
        name: 'AccessDenied',
        component: () => import('../views/errors/403.vue'),
        meta: {
            title: '403 | Access denied'
        }
    },
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: () => import('../views/errors/404.vue'),
        meta: {
            title: '404 | Page not found'
        }
    }
]

const BASE_URL = '/';
const router = createRouter({
    history: createWebHistory(BASE_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { x: 0, y: 0 };
    }
})
router.beforeEach((to, from, next) => {
    window.document.title = to.meta && to.meta.title ? to.meta.title : 'PDSCDCSL';
    let exceptRoutes = ['Signin', 'NotFound'];
    if (!exceptRoutes.find((route) => {
        return route === to.name
    })) {
        if (store.getters['auth/authenticated']) {
            //check route permission
            const permissions = store.getters['auth/permissions']
            if (to.meta.permission && !permissions.find(perm => {
                return perm.name === to.meta.permission
            })) {
                return next({
                    name: 'AccessDenied'
                })
            }
        } else {
            return next({
                name: 'Signin'
            })
        }
    }
    next();
})

export default router;

