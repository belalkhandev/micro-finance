import axios from "axios";

export default {
    namespaced: true,

    state: {
        dps_transactions: null,
        loan_transactions: null
    },

    getters: {
        dps_transactions(state){
            return state.dps_transactions
        },

        loan_transactions(state){
            return state.loan_transactions
        },

        dps_current_transactions(state){
            return state.dps_transactions
        },

        loan_current_transactions(state){
            return state.loan_transactions
        },
    },

    mutations: {
        SET_DPS_TRANSACTIONS(state, dps_transactions) {
            state.dps_transactions = dps_transactions
        },

        SET_LOAN_TRANSACTIONS(state, loan_transactions) {
            state.loan_transactions = loan_transactions
        },

        SET_CURRENT_DPS_TRANSACTIONS(state, dps_current_transactions) {
            state.dps_current_transactions = dps_current_transactions
        },

        SET_CURRENT_LOAN_TRANSACTIONS(state, loan_current_transactions) {
            state.loan_current_transactions = loan_current_transactions
        },
    },

    actions: {

        async getDpsTransactions({ commit }) {
            const res = await axios.get('report/dps')

            if (res.data.status) {
                commit('SET_DPS_TRANSACTIONS', res.data.dps_transactions)
            }
        },

        async getLoanTransactions({ commit }) {
            const res = await axios.get('report/loan')

            if (res.data.status) {
                commit('SET_LOAN_TRANSACTIONS', res.data.loan_transactions)
            }
        },

        async getCurrentDpsTransactions({ commit }) {
            const res = await axios.get('report/dps/today')

            if (res.data.status) {
                commit('SET_CURRENT_DPS_TRANSACTIONS', res.data.dps_transactions)
            }
        },

        async getCurrentLoanTransactions({ commit }) {
            const res = await axios.get('report/loan/today')

            if (res.data.status) {
                commit('SET_CURRENT_LOAN_TRANSACTIONS', res.data.loan_transactions)
            }
        },

    },
}
