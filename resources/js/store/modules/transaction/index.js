import axios from "axios";
import store from "../../index";

export default {
    namespaced: true,

    state: {
        dps_transactions: null,
        dps_unpaid_transactions: null,
        dps_paid_transactions: null,
        loan_transactions: null,
        loan_unpaid_transactions: null,
        loan_paid_transactions: null,
    },

    getters: {
        dps_transactions(state){
            return state.dps_transactions
        },

        loan_transactions(state){
            return state.loan_transactions
        },

        dps_unpaid_transactions(state){
            return state.dps_unpaid_transactions
        },

        loan_unpaid_transactions(state){
            return state.loan_unpaid_transactions
        },

        dps_paid_transactions(state){
            return state.dps_paid_transactions
        },

        loan_paid_transactions(state){
            return state.loan_paid_transactions
        },
    },

    mutations: {
        SET_DPS_TRANSACTIONS(state, dps_transactions) {
            state.dps_transactions = dps_transactions
        },

        SET_LOAN_TRANSACTIONS(state, loan_transactions) {
            state.loan_transactions = loan_transactions
        },

        SET_DPS_PAID_TRANSACTIONS(state, dps_transactions) {
            state.dps_paid_transactions = dps_transactions
        },

        SET_LOAN_PAID_TRANSACTIONS(state, loan_transactions) {
            state.loan_paid_transactions = loan_transactions
        },

        SET_DPS_UNPAID_TRANSACTIONS(state, dps_transactions) {
            state.dps_unpaid_transactions = dps_transactions
        },

        SET_LOAN_UNPAID_TRANSACTIONS(state, loan_transactions) {
            state.loan_unpaid_transactions = loan_transactions
        },

        UPDATE_DPS_TR(state, dps_transaction) {
            if (state.dps_unpaid_transactions) {
                const transaction  = state.dps_unpaid_transactions.data.find(item => item.id === dps_transaction.id)
                if (transaction) {
                    state.dps_unpaid_transactions.data.splice(state.dps_unpaid_transactions.data.indexOf(transaction), 1)
                }
            }

            if (state.dps_transactions) {
                const transaction  = state.dps_transactions.data.find(item => item.id === dps_transaction.id)
                if (transaction) {
                    state.dps_transactions.data.splice(state.dps_transactions.data.indexOf(transaction), 1)
                }
            }
        },

        UPDATE_LOAN_TR(state, loan_transaction) {
            if(state.loan_unpaid_transactions) {
                const transaction  = state.loan_unpaid_transactions.data.find(item => item.id === loan_transaction.id)
                if (transaction) {
                    state.loan_unpaid_transactions.data.splice(state.loan_unpaid_transactions.data.indexOf(transaction), 1)
                }
            }

            if(state.loan_transactions) {
                const transaction  = state.loan_transactions.data.find(item => item.id === loan_transaction.id)
                if (transaction) {
                    state.loan_transactions.data.splice(state.loan_transactions.data.indexOf(transaction), 1)
                }
            }
        },

        DELETE_DPS_TR(state, item_id) {
            const dps_transaction  = state.dps_transactions.data.find(item => item.id === item_id)
            if (dps_transaction) {
                state.dps_transactions.data.splice(state.dps_transactions.data.indexOf(dps_transaction), 1)
            }
        },

        DELETE_LOAN_TR(state, item_id) {
            const loan_transaction  = state.loan_transactions.data.find(item => item.id === item_id)
            if (loan_transaction) {
                state.loan_transactions.data.splice(state.loan_transactions.data.indexOf(loan_transaction), 1)
            }
        },
    },

    actions: {
        async getDpsTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/dps/list?page='+page_no)

            if (res.data.status) {
                commit('SET_DPS_TRANSACTIONS', res.data.dps_transactions)
            }
        },

        async filterDpsTransactions({ commit }, formData) {
            const res = await axios.get('transaction/dps/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_DPS_TRANSACTIONS', res.data.dps_transactions)
            } else {
                commit('SET_DPS_TRANSACTIONS', null)
            }
        },

        async getDpsUnpaidTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/dps/unpaid/list?page='+page_no)

            if (res.data.status) {
                commit('SET_DPS_UNPAID_TRANSACTIONS', res.data.dps_transactions)
            }
        },

        async filterDpsUnpaidTransactions({ commit }, formData) {
            const res = await axios.get('transaction/dps/unpaid/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_DPS_UNPAID_TRANSACTIONS', res.data.dps_transactions)
            } else {
                commit('SET_DPS_UNPAID_TRANSACTIONS', null)
            }
        },

        async getDpsPaidTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/dps/paid/list?page='+page_no)

            if (res.data.status) {
                commit('SET_DPS_PAID_TRANSACTIONS', res.data.dps_transactions)
            }
        },

        async filterDpsPaidTransactions({ commit }, formData) {
            const res = await axios.get('transaction/dps/paid/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_DPS_PAID_TRANSACTIONS', res.data.dps_transactions)
            } else {
                commit('SET_DPS_PAID_TRANSACTIONS', null)
            }
        },

        async getLoanTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/loan/list?page='+page_no)

            if (res.data.status) {
                commit('SET_LOAN_TRANSACTIONS', res.data.loan_transactions)
            }
        },

        async filterLoanTransactions({ commit }, formData) {
            const res = await axios.get('transaction/loan/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_LOAN_TRANSACTIONS', res.data.loan_transactions)
            } else {
                commit('SET_LOAN_TRANSACTIONS', null)
            }
        },

        async getLoanUnpaidTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/loan/unpaid/list?page='+page_no)

            if (res.data.status) {
                commit('SET_LOAN_UNPAID_TRANSACTIONS', res.data.loan_transactions)
            }
        },

        async filterLoanUnpaidTransactions({ commit }, formData) {
            const res = await axios.get('transaction/loan/unpaid/list', {
                params: formData
            })

            if (res.data.status) {
                console.log(res.data.loan_transactions)
                commit('SET_LOAN_UNPAID_TRANSACTIONS', res.data.loan_transactions)
            } else {
                commit('SET_LOAN_UNPAID_TRANSACTIONS', null)
            }
        },

        async getLoanPaidTransactions({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('transaction/loan/paid/list?page='+page_no)

            if (res.data.status) {
                commit('SET_LOAN_PAID_TRANSACTIONS', res.data.loan_transactions)
            }
        },

        async filterLoanPaidTransactions({ commit }, formData) {
            const res = await axios.get('transaction/loan/paid/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_LOAN_PAID_TRANSACTIONS', res.data.loan_transactions)
            } else {
                commit('SET_LOAN_PAID_TRANSACTIONS', null)
            }
        },

        async generateTransaction({ commit }, formdata) {
            const res = await axios.post('transaction/generate', formdata)

            if (res.data.status) {
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async collectDpsTransaction({ commit }, formdata) {
            const res = await axios.post('transaction/dps/collection', formdata)
            if (res.data.status) {
                commit('UPDATE_DPS_TR', res.data.transaction)
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async collectLoanTransaction({ commit }, formdata) {
            const res = await axios.post('transaction/loan/collection', formdata)
            if (res.data.status) {
                commit('UPDATE_LOAN_TR', res.data.transaction)
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async editExpenseCategory({ commit }, formdata) {
            const res = await axios.put('expense/categories/update/'+formdata.category_id, formdata)

            if (res.data.status) {
                commit('UPDATE_CATEGORY', res.data.expense)
                commit('SET_VALIDATION_ERRORS', null,  { root:true })
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_VALIDATION_ERRORS', res.data.errors ? res.data.errors : null, { root:true })
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },

        async deleteExpenseCategory({ commit }, item_id) {
            const res = await axios.delete('expense/categories/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_CATEGORY', item_id)
                commit('SET_ERROR_MESSAGE', null,  { root:true })
            } else {
                if (!res.data.status) {
                    commit('SET_ERROR_MESSAGE', res.data.message ? res.data.message : null, { root:true })
                }else {
                    console.log('Something went wrong');
                }
            }
        },
    },
}
