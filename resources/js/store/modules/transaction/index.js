import axios from "axios";

export default {
    namespaced: true,

    state: {
        expense_categories: null,
    },

    getters: {
        expense_categories(state){
            return state.expense_categories
        },
    },

    mutations: {
        SET_CATEGORIES(state, expense_categories) {
            state.expense_categories = expense_categories
        },

        SET_CATEGORY(state, expense) {
            if (state.expense_categories) {
                state.expense_categories.unshift(expense)
            }else {
                state.expense_categories = [expense]
            }
        },

        UPDATE_CATEGORY(state, expense) {
            const item = state.expense_categories.find(item => item.id === expense.id)
            Object.assign(item, expense)
        },

        DELETE_CATEGORY(state, item_id) {
            const expense  = state.expense_categories.find(item => item.id == item_id)
            if (expense) {
                state.expense_categories.splice(state.expense_categories.indexOf(expense), 1)
            }
        },
    },

    actions: {
        //expense actions
        async getExpenseCategories({ commit }) {
            const res = await axios.get('expense/categories/list')

            if (res.data.status) {
                commit('SET_CATEGORIES', res.data.categories)
            }
        },

        async createExpenseCategory({ commit }, formdata) {
            const res = await axios.post('expense/categories/create', formdata)

            if (res.data.status) {
                commit('SET_CATEGORY', res.data.category)
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
