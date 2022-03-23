import { createStore } from 'vuex'
import auth from './modules/auth'
import location from './modules/location'
import user from './modules/user'
import group from './modules/group'
import member from './modules/member'
import dps from './modules/dps'
import loan from './modules/loan'
import expense from './modules/expense'
import expenseCategory from "./modules/expense-category"
import transaction from "./modules/transaction"
import report from "./modules/report"
import dashboard from "./modules/dashboard";

export default createStore({
    state: {
        validation_errors: null,
        error_message: null
    },

    getters: {
        validation_errors (state) {
            return state.validation_errors
        },

        error_message (state) {
            return state.error_message
        }
    },

    mutations: {
        SET_VALIDATION_ERRORS (state, errors) {
            state.validation_errors = errors
        },

        SET_ERROR_MESSAGE (state, error) {
            state.error_message = error
        }
    },

    actions: {
        //
    },

    modules: {
        auth, user,
        location,
        group, member,
        dps, loan,
        expense, expenseCategory,
        transaction,
        dashboard,
        report
    }
})
