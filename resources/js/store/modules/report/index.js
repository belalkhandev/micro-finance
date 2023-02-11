import axios from "axios";

export default {
    namespaced: true,

    state: {
        dps_transactions: null,
        loan_transactions: null,
        current_dps_transactions: null,
        paid_dps_transactions: null,
        due_dps_transactions: null,
        current_loan_transactions: null,
        paid_loan_transactions: null,
        due_loan_transactions: null,
    },

    getters: {
        dps_transactions(state){
            return state.dps_transactions
        },

        loan_transactions(state){
            return state.loan_transactions
        },

        dps_current_transactions(state){
            return state.current_dps_transactions
        },

        dps_paid_transactions(state){
            return state.paid_dps_transactions
        },

        dps_due_transactions(state){
            return state.due_dps_transactions
        },

        loan_current_transactions(state){
            return state.current_loan_transactions
        },

        loan_paid_transactions(state){
            return state.paid_loan_transactions
        },

        loan_due_transactions(state){
            return state.due_loan_transactions
        },
    },

    mutations: {
        SET_DPS_TRANSACTIONS(state, transactions) {
            state.dps_transactions = transactions
        },

        SET_LOAN_TRANSACTIONS(state, transactions) {
            state.loan_transactions = transactions
        },

        SET_CURRENT_DPS_TRANSACTIONS(state, transactions) {
            state.current_dps_transactions = transactions
        },

        SET_PAID_DPS_TRANSACTIONS(state, transactions) {
            state.paid_dps_transactions = transactions
        },

        SET_DUE_DPS_TRANSACTIONS(state, transactions) {
            state.due_dps_transactions = transactions
        },

        SET_CURRENT_LOAN_TRANSACTIONS(state, transactions) {
            state.current_loan_transactions = transactions
        },

        SET_PAID_LOAN_TRANSACTIONS(state, transactions) {
            state.paid_loan_transactions = transactions
        },

        SET_DUE_LOAN_TRANSACTIONS(state, transactions) {
            state.due_loan_transactions = transactions
        },
    },

    actions: {

        async getDpsTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('report/dps?page='+page_no)
            if (res.data.status) {
                commit('SET_DPS_TRANSACTIONS', res.data.applications)
            }
        },

        async filterDpsTransactions({ commit }, formData) {
            const res = await axios.get('report/dps', {
                params: formData
            })
            if (res.data.status) {
                commit('SET_DPS_TRANSACTIONS', res.data.applications)
            } else {
                commit('SET_DPS_TRANSACTIONS', null)
            }
        },

        async getLoanTransactions({ commit  }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('report/loan?page='+page_no)
            if (res.data.status) {
                commit('SET_LOAN_TRANSACTIONS', res.data.applications)
            }
        },

        async filterLoanTransactions({ commit  }, formData) {
            const res = await axios.get('report/loan', {
                params: formData
            })
            if (res.data.status) {
                commit('SET_LOAN_TRANSACTIONS', res.data.applications)
            } else {
                commit('SET_LOAN_TRANSACTIONS', null)
            }
        },

        async getCurrentDpsTransactions({ commit }) {
            const res = await axios.get('report/dps/today')
            if (res.data.status) {
                commit('SET_CURRENT_DPS_TRANSACTIONS', res.data.applications)
            }
        },

        async getPaidDpsTransactions({ commit }) {
            const res = await axios.get('report/dps/paid')
            if (res.data.status) {
                commit('SET_PAID_DPS_TRANSACTIONS', res.data.applications)
            }
        },

        async getDueDpsTransactions({ commit }) {
            const res = await axios.get('report/dps/due')
            if (res.data.status) {
                commit('SET_DUE_DPS_TRANSACTIONS', res.data.applications)
            }
        },

        async getCurrentLoanTransactions({ commit }) {
            const res = await axios.get('report/loan/today')
            if (res.data.status) {
                commit('SET_CURRENT_LOAN_TRANSACTIONS', res.data.applications)
            }
        },

        async getPaidLoanTransactions({ commit }) {
            const res = await axios.get('report/loan/paid')
            if (res.data.status) {
                commit('SET_PAID_LOAN_TRANSACTIONS', res.data.applications)
            }
        },

        async getDueLoanTransactions({ commit }) {
            const res = await axios.get('report/loan/due')
            if (res.data.status) {
                commit('SET_DUE_LOAN_TRANSACTIONS', res.data.applications)
            }
        },

    },
}
