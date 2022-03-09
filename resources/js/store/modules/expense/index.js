import axios from "axios";

export default {
    namespaced: true,

    state: {
        expenses: null,
    },

    getters: {
        expenses(state){
            return state.expenses
        },
    },

    mutations: {
        SET_EXPENSES(state, expenses) {
            state.expenses = expenses
        },

        SET_EXPENSE(state, expense) {
            if (state.expenses) {
                state.expenses.unshift(expense)
            }else {
                state.expenses = [expense]
            }
        },

        UPDATE_EXPENSE(state, expense) {
            const item = state.expenses.find(item => item.id === expense.id)
            Object.assign(item, expense)
        },

        DELETE_EXPENSE(state, item_id) {
            const expense  = state.expenses.find(item => item.id == item_id)
            if (expense) {
                state.expenses.splice(state.expenses.indexOf(expense), 1)
            }
        },
    },

    actions: {
        //expense actions
        async getExpenses({ commit }) {
            const res = await axios.get('expense/list')

            if (res.data.status) {
                commit('SET_EXPENSES', res.data.expenses)
            }
        },

        async createExpense({ commit }, formdata) {
            const res = await axios.post('expense/create', formdata)

            if (res.data.status) {
                commit('SET_EXPENSE', res.data.expense)
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

        async editExpense({ commit }, formdata) {
            const res = await axios.put('expense/update/'+formdata.expense_id, formdata)

            if (res.data.status) {
                commit('UPDATE_EXPENSE', res.data.expense)
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

        async deleteExpense({ commit }, item_id) {
            const res = await axios.delete('expense/delete/'+item_id)
            if (res.data.status) {
                commit('DELETE_EXPENSE', item_id)
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
