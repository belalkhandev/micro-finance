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

        SET_CATEGORY(state, category) {
            if (state.expense_categories) {
                state.expense_categories.unshift(category)
            }else {
                state.expense_categories = [category]
            }
        },

        UPDATE_CATEGORY(state, category) {
            const item = state.expense_categories.find(item => item.id === category.id)
            Object.assign(item, category)
        },

        DELETE_CATEGORY(state, item_id) {
            const category  = state.expense_categories.find(item => item.id == item_id)
            if (category) {
                state.expense_categories.splice(state.expense_categories.indexOf(category), 1)
            }
        },
    },

    actions: {
        //expense actions
        async getExpenseCategories({ commit }) {
            const res = await axios.get('expense/category/list')

            if (res.data.status) {
                commit('SET_CATEGORIES', res.data.categories)
            }
        },

        async createExpenseCategory({ commit }, formdata) {
            const res = await axios.post('expense/category/create', formdata)

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

        async editExpenseCategory({ commit }, formdata) {
            const res = await axios.put('expense/category/update/'+formdata.category_id, formdata)

            if (res.data.status) {
                commit('UPDATE_CATEGORY', res.data.category)
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
            const res = await axios.delete('expense/category/delete/'+item_id)
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
