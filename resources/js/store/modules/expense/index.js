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
            if (state.expenses && state.expenses.data) {
                state.expenses.data.unshift(expense)
            }else {
                state.expenses.data = [expense]
            }
        },

        UPDATE_EXPENSE(state, expense) {
            if(state.expenses && state.expenses.data) {
                const item = state.expenses.data.find(item => item.id === expense.id)
                Object.assign(item, expense)
            }
        },

        DELETE_EXPENSE(state, item_id) {
            if(state.expenses && state.expenses.data) {
                const expense  = state.expenses.data.find(item => item.id == item_id)
                if (expense) {
                    state.expenses.data.splice(state.expenses.data.indexOf(expense), 1)
                }
            }
        },
    },

    actions: {
        async getExpenses({ commit }, page) {
            let page_no = page && page != 'undefined' ? page :  1
            const res = await axios.get('expense/list?page='+page_no)

            if (res.data.status) {
                commit('SET_EXPENSES', res.data.expenses)
            }
        },

        async filterExpenses({ commit }, formData) {
            const res = await axios.get('expense/list', {
                params: formData
            })

            if (res.data.status) {
                commit('SET_EXPENSES', res.data.expenses)
            } else {
                commit('SET_EXPENSES', null)
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
